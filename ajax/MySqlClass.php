<?php

/**
 * Created by @RodMoreno_.
 * User: Rodrigo Moreno
 * Date: 22/07/13
 * Time: 00:15 PM
 */

class MySqlLib
{
	var $servidor;
	var $usuario;
	var $password;
	var $bd;
	var $puerto;
	var $enlace;

	function __construct($_servidor, $_usuario, $_password, $_bd, $_puerto = 3306)
	{
		$this->setServidor($_servidor);
		$this->setUsuario($_usuario);
		$this->setPassword($_password);
		$this->setBD($_bd);
		$this->setPuerto($_puerto);
	}

	function conectar()
	{
		$enlace = new mysqli($this->getServidor(), $this->getUsuario(), $this->getPassword(), $this->getBD(), $this->getPuerto());

		$this->setEnlace($enlace);

		if ($this->getEnlace()->connect_errno)
			return false;
		return true;
	}

	function desconectar()
	{
		$this->getEnlace()->close();
	}

	function seleccionarBD()
	{
		$this->conectar();
		if (!mysqli_select_db($this->getEnlace(), $this->getBD()))
			return false;
		$this->desconectar();
		return true;
	}

	function ejecutar($consulta)
	{
		//$consulta = $this->getEnlace()->real_escape_string($consulta);

		$this->conectar();

		if (!$resultado = mysqli_query($this->getEnlace(), $consulta))
			return false;

		$this->desconectar();
		return $resultado;
	}

	/* Seters */
	function setServidor($_x)		{ $this->servidor = $_x; }
	function setUsuario($_x)		{ $this->usuario = $_x; }
	function setPassword($_x)		{ $this->password = $_x; }
	function setBD($_x)				{ $this->bd = $_x; }
	function setPuerto($_x)			{ $this->puerto = $_x; }
	function setEnlace($_x)			{ $this->enlace = $_x; }

	/* Geters */
	function getServidor()			{ return $this->servidor; }
	function getUsuario()			{ return $this->usuario; }
	function getPassword()			{ return $this->password; }
	function getBD()				{ return $this->bd; }
	function getPuerto()			{ return $this->puerto; }
	function getEnlace()			{ return $this->enlace; }
}