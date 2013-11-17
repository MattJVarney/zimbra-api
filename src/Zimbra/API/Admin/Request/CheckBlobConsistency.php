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
use Zimbra\Soap\Struct\IntIdAttr;
use Zimbra\Utils\TypedSequence;

/**
 * CheckBlobConsistency class
 * Checks for items that have no blob, blobs that have no item, and items that have an incorrect blob size stored in their metadata.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckBlobConsistency extends Request
{
    /**
     * The volume
     * @var array
     */
    private $_volumes;

    /**
     * The mbox
     * @var array
     */
    private $_mboxes;

    /**
     * The checkSize
     * @var bool
     */
    private $_checkSize;

    /**
     * The reportUsedBlobs
     * @var bool
     */
    private $_reportUsedBlobs;

    /**
     * Constructor method for CheckBlobConsistency
     * @param array $volumes
     * @param array $mboxes
     * @param bool  $checkSize
     * @param bool  $reportUsedBlobs
     * @return self
     */
    public function __construct(
        array $volumes = array(),
        array $mboxes = array(),
        $checkSize = null,
        $reportUsedBlobs = null)
    {
        parent::__construct();
        $this->_volumes = new TypedSequence('Zimbra\Soap\Struct\IntIdAttr', $volumes);
        $this->_mboxes = new TypedSequence('Zimbra\Soap\Struct\IntIdAttr', $mboxes);

        if(null !== $checkSize)
        {
            $this->_checkSize = (bool) $checkSize;
        }
        if(null !== $reportUsedBlobs)
        {
            $this->_reportUsedBlobs = (bool) $reportUsedBlobs;
        }
    }

    /**
     * Add a volume
     *
     * @param  IntIdAttr $volume
     * @return self
     */
    public function addVolume(IntIdAttr $volume)
    {
        $this->_volumes->add($volume);
        return $this;
    }

    /**
     * Gets volume sequence
     *
     * @return Sequence
     */
    public function volumes()
    {
        return $this->_volumes;
    }

    /**
     * Add a mbox
     *
     * @param  IntIdAttr $mbox
     * @return self
     */
    public function addMbox(IntIdAttr $mbox)
    {
        $this->_mboxes->add($mbox);
        return $this;
    }

    /**
     * Gets mbox sequence
     *
     * @return Sequence
     */
    public function mboxes()
    {
        return $this->_mboxes;
    }

    /**
     * Gets or sets checkSize
     *
     * @param  bool $checkSize
     * @return bool|self
     */
    public function checkSize($checkSize = null)
    {
        if(null === $checkSize)
        {
            return $this->_checkSize;
        }
        $this->_checkSize = (bool) $checkSize;
        return $this;
    }

    /**
     * Gets or sets reportUsedBlobs
     *
     * @param  bool $reportUsedBlobs
     * @return bool|self
     */
    public function reportUsedBlobs($reportUsedBlobs = null)
    {
        if(null === $reportUsedBlobs)
        {
            return $this->_reportUsedBlobs;
        }
        $this->_reportUsedBlobs = (bool) $reportUsedBlobs;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_checkSize))
        {
            $this->array['checkSize'] = $this->_checkSize ? 1 : 0;
        }
        if(is_bool($this->_reportUsedBlobs))
        {
            $this->array['reportUsedBlobs'] = $this->_reportUsedBlobs ? 1 : 0;
        }
        if(count($this->_volumes))
        {
            $this->array['volume'] = array();
            foreach ($this->_volumes as $volume)
            {
                $volumeArr = $volume->toArray('volume');
                $this->array['volume'][] = $volumeArr['volume'];
            }
        }
        if(count($this->_mboxes))
        {
            $this->array['mbox'] = array();
            foreach ($this->_mboxes as $mbox)
            {
                $mboxArr = $mbox->toArray('mbox');
                $this->array['mbox'][] = $mboxArr['mbox'];
            }
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
        if(is_bool($this->_checkSize))
        {
            $this->xml->addAttribute('checkSize', $this->_checkSize ? 1 : 0);
        }
        if(is_bool($this->_reportUsedBlobs))
        {
            $this->xml->addAttribute('reportUsedBlobs', $this->_reportUsedBlobs ? 1 : 0);
        }
        foreach ($this->_volumes as $volume)
        {
            $this->xml->append($volume->toXml('volume'));
        }
        foreach ($this->_mboxes as $mbox)
        {
            $this->xml->append($mbox->toXml('mbox'));
        }
        return parent::toXml();
    }
}
