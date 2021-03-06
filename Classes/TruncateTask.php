<?php
/***************************************************************
 * Copyright notice
 *
 * (c) 2009 AOE GmbH <dev@aoe.com>
 * All rights reserved
 *
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Export Task for sheduler
 * @package truncate_job
 */
class Tx_TruncateJob_TruncateTask extends tx_scheduler_Task {
	/**
	 * @var string
	 */
	private $tables;
	/**
	 * truncate tables
	 */
	public function execute() {
		foreach ( $this->getTableList () as $table ) {
			$this->truncateTable ($table);
		}
		return TRUE;
	}
	
	/**
	 * @return array
	 */
	public function getTableList() {
		$tables = explode ( ',', $this->tables );
		if(FALSE === $tables ){
			return array();
		}
		return $tables;
	}
	/**
	 * @return string
	 */
	public function getTables() {
		return $this->tables;
	}
	
	/**
	 * @param string $tables
	 */
	public function setTables($tables) {
		$this->tables = $tables;
	}
	/**
	 * @return t3lib_DB
	 */
	public function getDb() {
		return $GLOBALS ['TYPO3_DB'];
	}
	/**
	 * @param string $table
	 * @throws Exception
	 */
	private function truncateTable($table) {
		if (FALSE === $this->getDb ()->exec_TRUNCATEquery ( $table )) {
			throw new Exception ( 'Truncate of table ' . $table . ' failed ' );
		}
	}

}