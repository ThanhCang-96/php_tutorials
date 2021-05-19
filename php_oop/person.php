<?php
  class Person
  {
    var $name;
    var $address;
    // const age = 20;

    function setName($name){
      $this->name = $name;
    }
    function getName(){
      return $this->name;
    }

    function setAddress($address){
      $this->address = $address;
    }
    function getAddress(){
      return $this->address;
    }

    // function getAge(){
    //   return self::age;
    // }
  };
  // $connguoi = new Person();
  // $name = $connguoi->setName("Nguyễn Thành Cang");
  // $address = $connguoi->setAddress("Đại Lộc");
  // $age = $connguoi->getAge();
  // printf($name."-".$address."-".$age);

  class Student extends Person{
    var $age;
    function setAge($age){
      $this->age = $age;
    }
    function getAge(){
      return $this->age;
    }
  }

  class Employ extends Person{
    var $salary;
    function setAge($salary){
      $this->salary = $salary;
    }
  }

  $student = new Student();
  $student->setName("Nguyễn Văn A");
  $student->setAddress("Đại Lộc");
  $student->setAge(20);
  printf($student->getName()."-".$student->getAddress()."-".$student->getAge());
?>