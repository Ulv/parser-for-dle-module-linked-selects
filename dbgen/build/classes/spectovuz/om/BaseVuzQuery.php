<?php


/**
 * Base class that represents a query for the 'vuz' table.
 *
 *
 *
 * @method VuzQuery orderById($order = Criteria::ASC) Order by the id column
 * @method VuzQuery orderByTitle($order = Criteria::ASC) Order by the title column
 *
 * @method VuzQuery groupById() Group by the id column
 * @method VuzQuery groupByTitle() Group by the title column
 *
 * @method VuzQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VuzQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VuzQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method VuzQuery leftJoinSpecToVuz($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpecToVuz relation
 * @method VuzQuery rightJoinSpecToVuz($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpecToVuz relation
 * @method VuzQuery innerJoinSpecToVuz($relationAlias = null) Adds a INNER JOIN clause to the query using the SpecToVuz relation
 *
 * @method Vuz findOne(PropelPDO $con = null) Return the first Vuz matching the query
 * @method Vuz findOneOrCreate(PropelPDO $con = null) Return the first Vuz matching the query, or a new Vuz object populated from the query conditions when no match is found
 *
 * @method Vuz findOneById(int $id) Return the first Vuz filtered by the id column
 * @method Vuz findOneByTitle(string $title) Return the first Vuz filtered by the title column
 *
 * @method array findById(int $id) Return Vuz objects filtered by the id column
 * @method array findByTitle(string $title) Return Vuz objects filtered by the title column
 *
 * @package    propel.generator.spectovuz.om
 */
abstract class BaseVuzQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVuzQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'vuz', $modelName = 'Vuz', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VuzQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     VuzQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VuzQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VuzQuery) {
            return $criteria;
        }
        $query = new VuzQuery();
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
     * @return   Vuz|Vuz[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VuzPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VuzPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Vuz A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `TITLE` FROM `vuz` WHERE `ID` = :p0';
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
            $obj = new Vuz();
            $obj->hydrate($row);
            VuzPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Vuz|Vuz[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Vuz[]|mixed the list of results, formatted by the current formatter
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
     * @return VuzQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VuzPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VuzQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VuzPeer::ID, $keys, Criteria::IN);
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
     * @return VuzQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(VuzPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VuzQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VuzPeer::TITLE, $title, $comparison);
    }

    /**
     * Filter the query by a related SpecToVuz object
     *
     * @param   SpecToVuz|PropelObjectCollection $specToVuz  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   VuzQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySpecToVuz($specToVuz, $comparison = null)
    {
        if ($specToVuz instanceof SpecToVuz) {
            return $this
                ->addUsingAlias(VuzPeer::ID, $specToVuz->getVuzId(), $comparison);
        } elseif ($specToVuz instanceof PropelObjectCollection) {
            return $this
                ->useSpecToVuzQuery()
                ->filterByPrimaryKeys($specToVuz->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySpecToVuz() only accepts arguments of type SpecToVuz or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpecToVuz relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return VuzQuery The current query, for fluid interface
     */
    public function joinSpecToVuz($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpecToVuz');

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
            $this->addJoinObject($join, 'SpecToVuz');
        }

        return $this;
    }

    /**
     * Use the SpecToVuz relation SpecToVuz object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   SpecToVuzQuery A secondary query class using the current class as primary query
     */
    public function useSpecToVuzQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpecToVuz($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpecToVuz', 'SpecToVuzQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Vuz $vuz Object to remove from the list of results
     *
     * @return VuzQuery The current query, for fluid interface
     */
    public function prune($vuz = null)
    {
        if ($vuz) {
            $this->addUsingAlias(VuzPeer::ID, $vuz->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
