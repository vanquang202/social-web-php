<?php

class Database
{
    public $connect;
    public function __construct()
    {
        try {
            $this->connect = new PDO('mysql:host=localhost;dbname=facebook;charset=UTF8', 'quang', '1');
            // $this->connect = new PDO('mysql:host=localhost;dbname=facebook;charset=UTF8', 'quang', '');
        } catch (\Throwable $th) {
        }
    }

    public function all($limit = 0, $page = 0)
    {
        try {
            if ($limit == 0 && $page == 0) {
                $model = $this->connect->prepare("select * from " . $this->table . " order by id desc");
            } else {
                $model = $this->connect->prepare("select * from " . $this->table . " order by id desc limit $page , $limit");
            }
            if (isset($model)) {
                $model->execute();
                return $model->fetchAll();
            }
        } catch (\Throwable $e) {
            echo $e->getMessage();
            die;
        }
    }

    public function find($id)
    {
        try {
            //code...
            $model = $this->connect->prepare(" select * from " . $this->table . " where id = '$id'");
            $model->execute();
            return $model->fetch();
        } catch (\Throwable $th) {
        }
    }

    public function where($key, $value)
    {
        try {
            $model = $this->connect->prepare(" select * from " . $this->table . " where $key = '$value'" . " order by id desc");
            $model->execute();
            return $model->fetchAll();
        } catch (\Throwable $th) {
        }
    }

    public function whereAndWhere($array = 0, $arraySupper = 0, $limit = 0)
    {
        try {
            $dk = '';
            if ($arraySupper != 0) {
                foreach ($array as $key => $value) {
                    $dk .= ' ' .  $key . '=' . $value . ' and';
                }
            }
            if ($arraySupper != 0) {
                foreach ($arraySupper as $key => $val) {
                    $dk .= ' ' . $key . ' ' . $val . ' ';
                }
            }
            $dkN = rtrim($dk, "and");
            if ($limit > 0) {
                $model = $this->connect->prepare(" select * from " . $this->table . " where $dkN " . " order by id desc limit $limit");
            } else {
                $model = $this->connect->prepare(" select * from " . $this->table . " where $dkN " . " order by id desc  ");
            }
            $model->execute();
            return $model->fetchAll();
        } catch (\Throwable $th) {
        }
    }

    public function whereOne($key, $value)
    {
        try {
            //code...
            $model = $this->connect->prepare(" select * from " . $this->table . " where $key = '$value'");
            $model->execute();
            return $model->fetch();
        } catch (\Throwable $th) {
        }
    }

    public function create($arr)
    {
        $sql = " insert into " . $this->table;
        $keySql = " ( ";
        $valSql = " ( ";
        foreach ($arr as $key => $val) {
            $keySql .= " $key ,";
            $valSql .= " '$val' ,";
        }
        $keySql = rtrim($keySql, ",");
        $valSql = rtrim($valSql, ",");
        $keySql .= " )";
        $valSql .= " )";
        $sql .= $keySql . " values " . $valSql;
        $model = $this->connect->prepare($sql);
        return $model->execute();
    }

    public function update($arr, $id)
    {
        try {
            $sql = "update " . $this->table . " set ";
            foreach ($arr as $key => $val) {
                $sql .= " $key = '$val' ,";
            }
            $sql = rtrim($sql, ",");
            $sql .= " where id = " . $id;
            $model = $this->connect->prepare($sql);
            return $model->execute();
        } catch (\Throwable $th) {
        }
    }

    public function destroy($id)
    {
        $model = $this->connect->prepare(" delete from " . $this->table . " where id = '$id'");
        return $model->execute();
    }

    public function sql($sql)
    {
        $model = $this->connect->prepare($sql);
        $model->execute();
        return $model->fetchAll();
    }

    public function searchEmail($email)
    {
        $model = $this->connect->prepare(" select * from " . $this->table . " where email = '$email' " . " order by id desc");
        $model->execute();
        return  $model->fetch();
    }
}