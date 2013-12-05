<?php

namespace Spotlight\UserBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'spotlight_role' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Spotlight.UserBundle.Model.map
 */
class SpotlightRoleTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Spotlight.UserBundle.Model.map.SpotlightRoleTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('spotlight_role');
        $this->setPhpName('SpotlightRole');
        $this->setClassname('Spotlight\\UserBundle\\Model\\SpotlightRole');
        $this->setPackage('src.Spotlight.UserBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 65, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'spotlight_user', 'id', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SpotlightUser', 'Spotlight\\UserBundle\\Model\\SpotlightUser', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
    } // buildRelations()

} // SpotlightRoleTableMap
