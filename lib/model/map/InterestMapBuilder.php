<?php


/**
 * This class adds structure of 'ask_interest' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Fri Nov 28 19:33:21 2008
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class InterestMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.InterestMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(InterestPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InterestPeer::TABLE_NAME);
		$tMap->setPhpName('Interest');
		$tMap->setClassname('Interest');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('QUESTION_ID', 'QuestionId', 'INTEGER' , 'ask_question', 'ID', true, null);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'INTEGER' , 'ask_user', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // InterestMapBuilder
