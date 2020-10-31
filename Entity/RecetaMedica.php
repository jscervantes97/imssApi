<?php


class RecetaMedica
{

    private $idReceta  ;

    private $idUsuario ;

    private $fechaExpedicion ;

    private $status ;

    private $desloceMedicamentos ;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIdReceta()
    {
        return $this->idReceta;
    }

    /**
     * @param mixed $idReceta
     */
    public function setIdReceta($idReceta)
    {
        $this->idReceta = $idReceta;
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
    public function getFechaExpedicion()
    {
        return $this->fechaExpedicion;
    }

    /**
     * @param mixed $fechaExpedicion
     */
    public function setFechaExpedicion($fechaExpedicion)
    {
        $this->fechaExpedicion = $fechaExpedicion;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }



    /**
     * @return mixed
     */
    public function getDesloceMedicamentos()
    {
        return $this->desloceMedicamentos;
    }

    /**
     * @param mixed $desloceMedicamentos
     */
    public function setDesloceMedicamentos($desloceMedicamentos)
    {
        $this->desloceMedicamentos = $desloceMedicamentos;
    }

    public function toJson()
    {
        return
            [
                'idReceta' => $this->idReceta,
                'idUsuario' => $this->idUsuario,
                'fechaExpedicion' => $this->fechaExpedicion,
                'status' => $this->status,
                'medicamentos' => $this->desloceMedicamentos
            ];
    }

}