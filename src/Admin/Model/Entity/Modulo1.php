<?php
/*
 * STANDAR DE NISSI MODELO A LA BD MAESTROS
 * 
 */
namespace Confi\Model\Entity;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Modulo1 extends TableGateway
{
    private $id;
    private $nombre;
    private $tipo;
    private $link;
        
    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('c_mu1', $adapter, $databaseSchema,$selectResultPrototype);
    }

    private function cargaAtributos($datos=array())
    {
        $this->id     = $datos["id"];    
        $this->nombre = $datos["nombre"];   
        $this->tipo   = $datos["tipo"];   
        $this->link   = $datos["link"];   
    }
    
    public function getRegistro()
    {
       $datos = $this->select();
       return $datos->toArray();
    }
    
    public function actRegistro($data=array())
    {
       self::cargaAtributos($data);
       $id = $this->id;
       $datos=array
       (
           'nombre' => $this->nombre,
           'idM'    => $this->tipo,
           'link'   => $this->link
        );
       if ($id==0) // Nuevo registro
          $this->insert($datos);
       else // Mdificar registro
          $this->update($datos, array('id' => $id));
    }
    
    public function getRegistroId($id)
    {
       $id  = (int) $id;
       $rowset = $this->select(array('id' => $id));
       $row = $rowset->current();
      
       if (!$row) {
          throw new \Exception("No hay registros asociados al valor $id");
       }
       return $row;
     }        
     public function delRegistro($id)
     {
       $this->delete(array('id' => $id));               
     }
     
}
?>
