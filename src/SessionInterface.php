<?php
/*
 * This file is part of Skletter <https://github.com/2DSharp/Skletter>.
 *
 * (c) Dedipyaman Das <2d@twodee.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Predission;


interface SessionInterface
{
    public function getId();
    public function setId($id);
    public function getName() : string ;
    public function setName($name) : void;
    public function get($name, $default = null);
    public function set(string $name, $value);
    public function remove($name);
    public function has($name);
    public function isStarted();
    public function invalidate();


}