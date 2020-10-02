<?php
// Every Model MUST extends this class

namespace oFramework\Models;

use oFramework\Utils\Database;
use PDO;
use JsonSerializable;

abstract class CoreModel implements JsonSerializable {
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;

    /**
     * Méthode permettant de sauvegarder en BDD (insert ou update)
     * Si l'objet a un id => update
     * Sinon => insert
     * 
     * @return bool
     */
    public function save() {
        // Si l'id de l'objet courant est > 0
        if ($this->id > 0) {
            // alors, c'est qu'on veut mettre à jour la ligne dans la table
            return $this->update();
        }
        // Sinon
        else {
            // Alors on veut ajouter une ligne dans la table
            return $this->insert();
        }
    }

    public abstract static function find($id);
    public abstract static function findAll();
    protected abstract function insert();
    protected abstract function update();
    public abstract function delete();



    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}