<?php

	$host = 'localhost';
	$user = 'root';
	$password = 'puayap';


	$mysqli = new mysqli($host,$user,$password);
	if ($mysqli->connect_errno) {
		printf("Connection failed: %s\n", $mysqli->connect_error);
		die();
	}

	$mysqli -> query("create database spso;");
	$mysqli -> query("use spso;");
	$mysqli -> query("create table office(office_name VARCHAR(60) NOT NULL PRIMARY KEY);");
	$mysqli -> query("create table employee(
    								employee_id varchar(30) PRIMARY KEY NOT NULL,
								    employee_name varchar(50) NOT NULL,
								    employee_position varchar(40) not null);");
	$mysqli -> query("create table belongs(
										employee_id VARCHAR(30) primary key not null,
								    foreign key(employee_id) references employee(employee_id),
    								office_name varchar(60) not null,
    								foreign key(office_name) references office(office_name));");
	$mysqli -> query("create table approving_employee(
    								employee_id varchar(30) primary key not null,
    								foreign key (employee_id) references employee(employee_id));");
	$mysqli -> query("create table RIS(
    								RIS_no varchar(20) primary key not null,
    								purpose varchar(40) not null,
    								employee_id varchar(30) not null,
    								foreign key (employee_id ) references employee(employee_id));");
	$mysqli -> query("create table supplies(
    								stock_no varchar(15) primary key not null,
    								description varchar(50) not null,
    								unit varchar(15) not null,
    								qty smallint not null);");
	$mysqli -> query("create table contain(
    								RIS_no varchar(20) not null,
    								foreign key(RIS_no) references RIS(RIS_no),
    								stock_no varchar(15) not null,
    								foreign key(stock_no) references supplies(stock_no),
  									quantity smallint not null);");
	$mysqli -> query("create table client_user_table(
    								username varchar(15) primary key not null,
    								password varchar(32) not null,
    								employee_id varchar(30),
		    						foreign key(employee_id) references employee(employee_id));");
	$mysqli -> query("create table officer_user_table(
									  username varchar(15) primary key not null,
									  password varchar(32) not null,
									  employee_id varchar(30),
										foreign key(employee_id) references employee(employee_id));");
	echo "yawa"	;
?>
