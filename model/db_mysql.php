<?php
/*
 * Session Management for PHP3
 *
 * Copyright (c) 1998-2000 NetUSE AG
 *                    Boris Erdmann, Kristian Koehntopp
 *
 * $Id: db_pgsql.inc,v 1.2 2001/10/10 03:16:23 bozz Exp $
 *
 */



  function InsertQuery($table, $values)
  {
  	// The list of fields in the insert query
  	$fields = array();
  
  	// The quoted values ready for insertion
  	$quoted = array();
  
  	foreach ($values as $f => $v)
  	{
  		$fields[] = $f;
  		$quoted[] = "'$v'";
  	}
  
  	$fields = join(',', $fields);
  	$quoted = join(',', $quoted);
  
  	$q = "INSERT INTO $table ($fields) VALUES ($quoted)";
  
  	return $q;
      //return true;
  }
  
  function UpdateQuery($table, $values, $where = NULL)
  {
  	// The list of fields in the query
  	$fields = array();
  
  	foreach ($values as $f => $v)
  	{
  		$fields[] = "$f='$v'";
  	}
  
  	$fields = join(',', $fields);
  
  	if ($where !== NULL)
  	{
  		$where = "WHERE $where";
  	}
  
  	$q = "UPDATE $table SET $fields $where";
  
  	return $q;
  }
?>