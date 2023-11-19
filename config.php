<?php
const HOST_NAME = 'localhost';
const DB_USERNAME  = 'root';
const DB_PASSWORD  = '';
const DB_NAME  = 'store';

function db_connect()
{
    return mysqli_connect(HOST_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
}

function redirect_page($page_url)
{
    header('location:'. $page_url);
    die();
}
