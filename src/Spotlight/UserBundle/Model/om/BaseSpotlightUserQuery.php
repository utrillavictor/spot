<?php

namespace Spotlight\UserBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Spotlight\UserBundle\Model\SpotlightRole;
use Spotlight\UserBundle\Model\SpotlightUser;
use Spotlight\UserBundle\Model\SpotlightUserPeer;
use Spotlight\UserBundle\Model\SpotlightUserQuery;

/**
 * @method SpotlightUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SpotlightUserQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method SpotlightUserQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method SpotlightUserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method SpotlightUserQuery orderByZip($order = Criteria::ASC) Order by the zip column
 * @method SpotlightUserQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method SpotlightUserQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 *
 * @method SpotlightUserQuery groupById() Group by the id column
 * @method SpotlightUserQuery groupByUsername() Group by the username column
 * @method SpotlightUserQuery groupByPassword() Group by the password column
 * @method SpotlightUserQuery groupByEmail() Group by the email column
 * @method SpotlightUserQuery groupByZip() Group by the zip column
 * @method SpotlightUserQuery groupByFirstName() Group by the first_name column
 * @method SpotlightUserQuery groupByLastName() Group by the last_name column
 *
 * @method SpotlightUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SpotlightUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SpotlightUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SpotlightUserQuery leftJoinSpotlightRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpotlightRole relation
 * @method SpotlightUserQuery rightJoinSpotlightRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpotlightRole relation
 * @method SpotlightUserQuery innerJoinSpotlightRole($relationAlias = null) Adds a INNER JOIN clause to the query using the SpotlightRole relation
 *
 * @method SpotlightUser findOne(PropelPDO $con = null) Return the first SpotlightUser matching the query
 * @method SpotlightUser findOneOrCreate(PropelPDO $con = null) Return the first SpotlightUser matching the query, or a new SpotlightUser object populated from the query conditions when no match is found
 *
 * @method SpotlightUser findOneByUsername(string $username) Return the first SpotlightUser filtered by the username column
 * @method SpotlightUser findOneByPassword(string $password) Return the first SpotlightUser filtered by the password column
 * @method SpotlightUser findOneByEmail(string $email) Return the first SpotlightUser filtered by the email column
 * @method SpotlightUser findOneByZip(int $zip) Return the first SpotlightUser filtered by the zip column
 * @method SpotlightUser findOneByFirstName(string $first_name) Return the first SpotlightUser filtered by the first_name column
 * @method SpotlightUser findOneByLastName(string $last_name) Return the first SpotlightUser filtered by the last_name column
 *
 * @method array findById(int $id) Return SpotlightUser objects filtered by the id column
 * @method array findByUsername(string $username) Return SpotlightUser objects filtered by the username column
 * @method array findByPassword(string $password) Return SpotlightUser objects filtered by the password column
 * @method array findByEmail(string $email) Return SpotlightUser objects filtered by the email column
 * @method array findByZip(int $zip) Return SpotlightUser objects filtered by the zip column
 * @method array findByFirstName(string $first_name) Return SpotlightUser objects filtered by the first_name column
 * @method array findByLastName(string $last_name) Return SpotlightUser objects filtered by the last_name column
 */
abstract class BaseSpotlightUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSpotlightUserQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'spotlight';
        }
        if (null === $modelName) {
            $modelName = 'Spotlight\\UserBundle\\Model\\SpotlightUser';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SpotlightUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SpotlightUserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SpotlightUserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SpotlightUserQuery) {
            return $criteria;
        }
        $query = new SpotlightUserQuery(null, null, $modelAlias);

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
     * @return   SpotlightUser|SpotlightUser[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SpotlightUserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SpotlightUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 SpotlightUser A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 SpotlightUser A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `username`, `password`, `email`, `zip`, `first_name`, `last_name` FROM `spotlight_user` WHERE `id` = :p0';
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
            $obj = new SpotlightUser();
            $obj->hydrate($row);
            SpotlightUserPeer::addInstanceToPool($obj, (string) $key);
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
     * @return SpotlightUser|SpotlightUser[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|SpotlightUser[]|mixed the list of results, formatted by the current formatter
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
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SpotlightUserPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SpotlightUserPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SpotlightUserPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SpotlightUserPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpotlightUserPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SpotlightUserPeer::USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SpotlightUserPeer::PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SpotlightUserPeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the zip column
     *
     * Example usage:
     * <code>
     * $query->filterByZip(1234); // WHERE zip = 1234
     * $query->filterByZip(array(12, 34)); // WHERE zip IN (12, 34)
     * $query->filterByZip(array('min' => 12)); // WHERE zip >= 12
     * $query->filterByZip(array('max' => 12)); // WHERE zip <= 12
     * </code>
     *
     * @param     mixed $zip The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function filterByZip($zip = null, $comparison = null)
    {
        if (is_array($zip)) {
            $useMinMax = false;
            if (isset($zip['min'])) {
                $this->addUsingAlias(SpotlightUserPeer::ZIP, $zip['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($zip['max'])) {
                $this->addUsingAlias(SpotlightUserPeer::ZIP, $zip['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SpotlightUserPeer::ZIP, $zip, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%'); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstName)) {
                $firstName = str_replace('*', '%', $firstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SpotlightUserPeer::FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%'); // WHERE last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function filterByLastName($lastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastName)) {
                $lastName = str_replace('*', '%', $lastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SpotlightUserPeer::LAST_NAME, $lastName, $comparison);
    }

    /**
     * Filter the query by a related SpotlightRole object
     *
     * @param   SpotlightRole|PropelObjectCollection $spotlightRole  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SpotlightUserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySpotlightRole($spotlightRole, $comparison = null)
    {
        if ($spotlightRole instanceof SpotlightRole) {
            return $this
                ->addUsingAlias(SpotlightUserPeer::ID, $spotlightRole->getUserId(), $comparison);
        } elseif ($spotlightRole instanceof PropelObjectCollection) {
            return $this
                ->useSpotlightRoleQuery()
                ->filterByPrimaryKeys($spotlightRole->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySpotlightRole() only accepts arguments of type SpotlightRole or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpotlightRole relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function joinSpotlightRole($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpotlightRole');

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
            $this->addJoinObject($join, 'SpotlightRole');
        }

        return $this;
    }

    /**
     * Use the SpotlightRole relation SpotlightRole object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Spotlight\UserBundle\Model\SpotlightRoleQuery A secondary query class using the current class as primary query
     */
    public function useSpotlightRoleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpotlightRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpotlightRole', '\Spotlight\UserBundle\Model\SpotlightRoleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   SpotlightUser $spotlightUser Object to remove from the list of results
     *
     * @return SpotlightUserQuery The current query, for fluid interface
     */
    public function prune($spotlightUser = null)
    {
        if ($spotlightUser) {
            $this->addUsingAlias(SpotlightUserPeer::ID, $spotlightUser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
