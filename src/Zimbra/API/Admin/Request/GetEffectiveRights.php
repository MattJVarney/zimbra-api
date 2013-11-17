<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\EffectiveRightsTargetSelector as Target;
use Zimbra\Soap\Struct\GranteeSelector as Grantee;
use Zimbra\Soap\Enum\AttrMethod;

/**
 * GetEffectiveRights class
 * Returns effective ADMIN rights the authenticated admin has on the specified target entry.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetEffectiveRights extends Request
{
    /**
     * Target
     * @var Target
     */
    private $_target;

    /**
     * Grantee
     * @var Grantee
     */
    private $_grantee;

    /**
     * Whether to include all attribute names in the <getAttrs>/<setAttrs> elements in the response if all attributes of the target are gettable/settable.
     * @var AttrMethod
     */
    private $_expandAllAttrs;

    /**
     * Constructor method for GetEffectiveRights
     * @param  Target $target
     * @param  Grantee $grantee
     * @param  string $expandAllAttrs
     * @return self
     */
    public function __construct(
        Target $target,
        Grantee $grantee = null,
        AttrMethod $expandAllAttrs = null)
    {
        parent::__construct();
        $this->_target = $target;
        if($grantee instanceof Grantee)
        {
            $this->_grantee = $grantee;
        }
        if($expandAllAttrs instanceof AttrMethod)
        {
            $this->_expandAllAttrs = $expandAllAttrs;
        }
    }

    /**
     * Gets or sets target
     *
     * @param  Target $target
     * @return Target|self
     */
    public function target(Target $target = null)
    {
        if(null === $target)
        {
            return $this->_target;
        }
        $this->_target = $target;
        return $this;
    }

    /**
     * Gets or sets grantee
     *
     * @param  Grantee $grantee
     * @return Grantee|self
     */
    public function grantee(Grantee $grantee = null)
    {
        if(null === $grantee)
        {
            return $this->_grantee;
        }
        $this->_grantee = $grantee;
        return $this;
    }

    /**
     * Gets or sets expandAllAttrs
     *
     * @param  string $expandAllAttrs
     * @return string|self
     */
    public function expandAllAttrs(AttrMethod $expandAllAttrs = null)
    {
        if(null === $expandAllAttrs)
        {
            return $this->_expandAllAttrs;
        }
        $this->_expandAllAttrs = $expandAllAttrs;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_target->toArray();
        if($this->_grantee instanceof Grantee)
        {
            $this->array += $this->_grantee->toArray();
        }
        if($this->_expandAllAttrs instanceof AttrMethod)
        {
            $this->array['expandAllAttrs'] = (string) $this->_expandAllAttrs;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_target->toXml());
        if($this->_grantee instanceof Grantee)
        {
            $this->xml->append($this->_grantee->toXml());
        }
        if($this->_expandAllAttrs instanceof AttrMethod)
        {
            $this->xml->addAttribute('expandAllAttrs', (string) $this->_expandAllAttrs);
        }
        return parent::toXml();
    }
}
