<?php


/**
 * Base class that represents a query for the 'spectovuz' table.
 *
 *
 *
 * @method SpecToVuzQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SpecToVuzQuery orderBySpecId($order = Criteria::ASC) Order by the spec_id column
 * @method SpecToVuzQuery orderByRegionId($order = Criteria::ASC) Order by the region_id column
 * @method SpecToVuzQuery orderByVuzId($order = Criteria::ASC) Order by the vuz_id column
 *
 * @method SpecToVuzQuery groupById() Group by the id column
 * @method SpecToVuzQuery groupBySpecId() Group by the spec_id column
 * @method SpecToVuzQuery groupByRegionId() Group by the region_id column
 * @method SpecToVuzQuery groupByVuzId() Group by the vuz_id column
 *
 * @method SpecToVuzQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SpecToVuzQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SpecToVuzQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SpecToVuzQuery leftJoinSpec($relationAlias = null) Adds a LEFT JOIN clause to the query using the Spec relation
 * @method SpecToVuzQuery rightJoinSpec($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Spec relation
 * @method SpecToVuzQuery innerJoinSpec($relationAlias = null) Adds a INNER JOIN clause to the query using the Spec relation
 *
 * @method SpecToVuzQuery leftJoinRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Region relation
 * @method SpecToVuzQuery rightJoinRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Region relation
 * @method SpecToVuzQuery innerJoinRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the Region relation
 *
 * @method SpecToVuzQuery leftJoinVuz($relationAlias = null) Adds a LEFT JOIN clause to the query using the Vuz relation
 * @method SpecToVuzQuery rightJoinVuz($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Vuz relation
 * @method SpecToVuzQuery innerJoinVuz($relationAlias = null) Adds a INNER JOIN clause to the query using the Vuz relation
 *
 * @method SpecToVuz findOne(PropelPDO $con = null) Return the first SpecToVuz matching the query
 * @method SpecToVuz findOneOrCreate(PropelPDO $con = null) Return the first SpecToVuz matching the query, or a new SpecToVuz object populated from the query conditions when no match is found
 *
 * @method SpecToVuz findOneById(int $id) Return the first SpecToVuz filtered by the id column
 * @method SpecToVuz findOneBySpecId(int $spec_id) Return the first SpecToVuz filtered by the spec_id column
 * @method SpecToVuz findOneByRegionId(int $region_id) Return the first SpecToVuz filtered by the region_id column
 * @method SpecToVuz findOneByVuzId(int $vuz_id) Return the first SpecToVuz filtered by the vuz_id column
 *
 * @method array findById(int $id) Return SpecToVuz objects filtered by the id column
 * @method array findBySpecId(int $spec_id) Return SpecToVuz objects filtered by the spec_id column
 * @method array findByRegionId(int $region_id) Return SpecToVuz objects filtered by the region_id column
 * @method array findByVuzId(int $vuz_id) Return SpecToVuz objects filtered by the vuz_id column
 *
 * @package    propel.generator.spectovuz.om
 */
abstract class BaseSpecToVuzQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSpecToVuzQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'vuz', $modelName = 'SpecToVuz', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SpecToVuzQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     SpecToVuzQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SpecToVuzQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SpecToVuzQuery) {
            return $criteria;
        }
        $query = new SpecToVuzQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   SpecToVuz|SpecToVuz[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SpecToVuzPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SpecToVuzPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   SpecToVuz A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `SPEC_ID`, `REGION_ID`, `VUZ_ID` FROM `spectovuz` WHERE `ID` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new SpecToVuz();
            $obj->hydrate($row);
            SpecToVuzPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return SpecToVuz|SpecToVuz[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|SpecToVuz[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SpecToVuzPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SpecToVuzPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(SpecToVuzPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the spec_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySpecId(1234); // WHERE spec_id = 1234
     * $query->filterBySpecId(array(12, 34)); // WHERE spec_id IN (12, 34)
     * $query->filterBySpecId(array('min' => 12)); // WHERE spec_id > 12
     * </code>
     *
     * @see       filterBySpec()
     *
     * @param     mixed $specId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function filterBySpecId($specId = null, $comparison = null)
    {
        if (is_array($specId)) {
            $useMinMax = false;
            if (isset($specId['min'])) {
                $this->addUsingAlias(SpecToVuzPeer::SPEC_ID, $specId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($specId['max'])) {
                $this->addUsingAlias(SpecToVuzPeer::SPEC_ID, $specId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecToVuzPeer::SPEC_ID, $specId, $comparison);
    }

    /**
     * Filter the query on the region_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRegionId(1234); // WHERE region_id = 1234
     * $query->filterByRegionId(array(12, 34)); // WHERE region_id IN (12, 34)
     * $query->filterByRegionId(array('min' => 12)); // WHERE region_id > 12
     * </code>
     *
     * @see       filterByRegion()
     *
     * @param     mixed $regionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function filterByRegionId($regionId = null, $comparison = null)
    {
        if (is_array($regionId)) {
            $useMinMax = false;
            if (isset($regionId['min'])) {
                $this->addUsingAlias(SpecToVuzPeer::REGION_ID, $regionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($regionId['max'])) {
                $this->addUsingAlias(SpecToVuzPeer::REGION_ID, $regionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecToVuzPeer::REGION_ID, $regionId, $comparison);
    }

    /**
     * Filter the query on the vuz_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVuzId(1234); // WHERE vuz_id = 1234
     * $query->filterByVuzId(array(12, 34)); // WHERE vuz_id IN (12, 34)
     * $query->filterByVuzId(array('min' => 12)); // WHERE vuz_id > 12
     * </code>
     *
     * @see       filterByVuz()
     *
     * @param     mixed $vuzId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function filterByVuzId($vuzId = null, $comparison = null)
    {
        if (is_array($vuzId)) {
            $useMinMax = false;
            if (isset($vuzId['min'])) {
                $this->addUsingAlias(SpecToVuzPeer::VUZ_ID, $vuzId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vuzId['max'])) {
                $this->addUsingAlias(SpecToVuzPeer::VUZ_ID, $vuzId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpecToVuzPeer::VUZ_ID, $vuzId, $comparison);
    }

    /**
     * Filter the query by a related Spec object
     *
     * @param   Spec|PropelObjectCollection $spec The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SpecToVuzQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySpec($spec, $comparison = null)
    {
        if ($spec instanceof Spec) {
            return $this
                ->addUsingAlias(SpecToVuzPeer::SPEC_ID, $spec->getId(), $comparison);
        } elseif ($spec instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SpecToVuzPeer::SPEC_ID, $spec->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySpec() only accepts arguments of type Spec or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Spec relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function joinSpec($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Spec');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Spec');
        }

        return $this;
    }

    /**
     * Use the Spec relation Spec object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   SpecQuery A secondary query class using the current class as primary query
     */
    public function useSpecQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpec($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Spec', 'SpecQuery');
    }

    /**
     * Filter the query by a related Region object
     *
     * @param   Region|PropelObjectCollection $region The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SpecToVuzQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRegion($region, $comparison = null)
    {
        if ($region instanceof Region) {
            return $this
                ->addUsingAlias(SpecToVuzPeer::REGION_ID, $region->getId(), $comparison);
        } elseif ($region instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SpecToVuzPeer::REGION_ID, $region->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRegion() only accepts arguments of type Region or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Region relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function joinRegion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Region');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Region');
        }

        return $this;
    }

    /**
     * Use the Region relation Region object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   RegionQuery A secondary query class using the current class as primary query
     */
    public function useRegionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Region', 'RegionQuery');
    }

    /**
     * Filter the query by a related Vuz object
     *
     * @param   Vuz|PropelObjectCollection $vuz The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SpecToVuzQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByVuz($vuz, $comparison = null)
    {
        if ($vuz instanceof Vuz) {
            return $this
                ->addUsingAlias(SpecToVuzPeer::VUZ_ID, $vuz->getId(), $comparison);
        } elseif ($vuz instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SpecToVuzPeer::VUZ_ID, $vuz->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVuz() only accepts arguments of type Vuz or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Vuz relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function joinVuz($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Vuz');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Vuz');
        }

        return $this;
    }

    /**
     * Use the Vuz relation Vuz object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   VuzQuery A secondary query class using the current class as primary query
     */
    public function useVuzQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVuz($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Vuz', 'VuzQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   SpecToVuz $specToVuz Object to remove from the list of results
     *
     * @return SpecToVuzQuery The current query, for fluid interface
     */
    public function prune($specToVuz = null)
    {
        if ($specToVuz) {
            $this->addUsingAlias(SpecToVuzPeer::ID, $specToVuz->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
