<?php



/**
 * This class defines the structure of the 'spectovuz' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.spectovuz.map
 */
class SpecToVuzTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'spectovuz.map.SpecToVuzTableMap';

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
        $this->setName('spectovuz');
        $this->setPhpName('SpecToVuz');
        $this->setClassname('SpecToVuz');
        $this->setPackage('spectovuz');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('SPEC_ID', 'SpecId', 'INTEGER', 'spec', 'ID', true, null, null);
        $this->addForeignKey('REGION_ID', 'RegionId', 'INTEGER', 'region', 'ID', true, null, null);
        $this->addForeignKey('VUZ_ID', 'VuzId', 'INTEGER', 'vuz', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Spec', 'Spec', RelationMap::MANY_TO_ONE, array('spec_id' => 'id', ), null, null);
        $this->addRelation('Region', 'Region', RelationMap::MANY_TO_ONE, array('region_id' => 'id', ), null, null);
        $this->addRelation('Vuz', 'Vuz', RelationMap::MANY_TO_ONE, array('vuz_id' => 'id', ), null, null);
    } // buildRelations()

} // SpecToVuzTableMap
