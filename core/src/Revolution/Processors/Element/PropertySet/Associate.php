<?php
/*
 * This file is part of the MODX Revolution package.
 *
 * Copyright (c) MODX, LLC
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MODX\Revolution\Processors\Element\PropertySet;


use MODX\Revolution\modPropertySet;

/**
 * Associates a property set to an element, or creates a property set
 *
 * @package MODX\Revolution\Processors\Element\PropertySet
 */
class Associate extends AddElement
{
    /**
     * Grab Property Set to check if it exists or create new and get its ID
     *
     * @param $propertySetId
     *
     * @return bool|null|string
     */
    public function getPropertySet(&$propertySetId)
    {
        // set up proper field names
        $this->setProperty($this->elementKey, $this->getProperty('elementId'));
        $this->setProperty($this->element_class, $this->getProperty('elementType'));
        $this->unsetProperty('elementId');
        $this->unsetProperty('elementType');

        $isNew = $this->getProperty('propertyset_new', false);
        $isNew = ($isNew == 'false') ? false : $isNew;
        if (!$isNew) {
            return parent::getPropertySet($propertySetId);
        }

        $setName = trim($this->getProperty('name', ''));
        if (empty($setName)) {
            return $this->modx->lexicon($this->objectType . '_err_ns_name');
        }

        /* if property set already exists with that name */
        $ae = $this->modx->getObject(modPropertySet::class, ['name' => $setName]);
        if ($ae) {
            return $this->modx->lexicon($this->objectType . '_err_ae');
        }

        $set = $this->modx->newObject(modPropertySet::class);
        $set->set('name', $setName);
        $set->set('description', $this->getProperty('description', ''));
        if ($set->save() === false) {
            return $this->modx->lexicon($this->objectType . '_err_associate');
        }
        $propertySetId = $set->get('id');

        return true;
    }
}
