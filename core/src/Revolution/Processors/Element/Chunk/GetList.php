<?php
/*
 * This file is part of the MODX Revolution package.
 *
 * Copyright (c) MODX, LLC
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MODX\Revolution\Processors\Element\Chunk;


use MODX\Revolution\modChunk;

/**
 * Grabs a list of chunks.
 *
 * @property integer $start (optional) The record to start at. Defaults to 0.
 * @property integer $limit (optional) The number of records to limit to. Defaults
 * to 10.
 * @property string  $sort  (optional) The column to sort by. Defaults to name.
 * @property string  $dir   (optional) The direction of the sort. Defaults to ASC.
 *
 * @package MODX\Revolution\Processors\Element\Chunk
 */
class GetList extends \MODX\Revolution\Processors\Element\GetList
{
    public $classKey = modChunk::class;
    public $languageTopics = ['chunk', 'category'];
    public $permission = 'view_chunk';
}
