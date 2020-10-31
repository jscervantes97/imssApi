<?php

class User
{

    private $idUsuario ;

    private $nombres ;

    private $apellidoPaterno ;

    private $apellidoMaterno ;

    private $correo ;

    private $numeroCelular ;

    private $contra;

    private $accessToken;

    private $nss ;

    private $idClinica ;

    private $domicilio ;

    function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * @param mixed $nombres
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * @return mixed
     */
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    /**
     * @param mixed $apellidoPaterno
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;
    }

    /**
     * @return mixed
     */
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    /**
     * @param mixed $apellidoMaterno
     */
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getNumeroCelular()
    {
        return $this->numeroCelular;
    }

    /**
     * @param mixed $numeroCelular
     */
    public function setNumeroCelular($numeroCelular)
    {
        $this->numeroCelular = $numeroCelular;
    }

    /**
     * @return mixed
     */
    public function getContra()
    {
        return $this->contra;
    }

    /**
     * @param mixed $contra
     */
    public function setContra($contra)
    {
        $this->contra = $contra;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param mixed $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return mixed
     */
    public function getNss()
    {
        return $this->nss;
    }

    /**
     * @param mixed $nss
     */
    public function setNss($nss)
    {
        $this->nss = $nss;
    }

    /**
     * @return mixed
     */
    public function getIdClinica()
    {
        return $this->idClinica;
    }

    /**
     * @param mixed $idClinica
     */
    public function setIdClinica($idClinica)
    {
        $this->idClinica = $idClinica;
    }

    /**
     * @return mixed
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * @param mixed $domicilio
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }


    public function toJson()
    {
        return
            [
                'idUsuario'   => $this->getIdUsuario(),
                'nombres' => $this->getNombres(),
                'apellidoPaterno' => $this->getApellidoPaterno(),
                'apellidoMaterno' => $this->getApellidoMaterno(),
                'correo' => $this->getCorreo(),
                'numeroCelular' => $this->getNumeroCelular(),
                'token' => $this->getAccessToken(),
                'nss' => $this->getNss(),
                'idClinica' => $this->getIdClinica(),
                'domicilio' => $this->getDomicilio()
            ];
    }


}