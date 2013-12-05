<?php

namespace Spotlight\UserBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'spotlight_user' table.
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
class SpotlightUserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Spotlight.UserBundle.Model.map.SpotlightUserTableMap';

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
        $this->setName('spotlight_user');
        $this->setPhpName('SpotlightUser');
        $this->setClassname('Spotlight\\UserBundle\\Model\\SpotlightUser');
        $this->setPackage('src.Spotlight.UserBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 65, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('zip', 'Zip', 'INTEGER', false, null, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, 65, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, 65, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('SpotlightRole', 'Spotlight\\UserBundle\\Model\\SpotlightRole', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'SpotlightRoles');
    } // buildRelations()

} // SpotlightUserTableMap
