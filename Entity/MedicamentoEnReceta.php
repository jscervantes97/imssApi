<?php


class MedicamentoEnReceta
{

    private $nombreMedicamento;

    private $cantidad;

    private $disponible ;

    /**
     * @return mixed
     */
    public function getNombreMedicamento()
    {
        return $this->nombreMedicamento;
    }

    /**
     * @param mixed $nombreMedicamento
     */
    public function setNombreMedicamento($nombreMedicamento)
    {
        $this->nombreMedicamento = $nombreMedicamento;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return mixed
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * @param mixed $disponible
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    }



    public function __construct()
    {
    }

    public function toJson()
    {
        return
            [
                'nombreMedicamento'   => $this->getNombreMedicamento(),
                'cantidad' => $this->getCantidad(),
                'disponible' => $this->getDisponible()
            ];
    }


}