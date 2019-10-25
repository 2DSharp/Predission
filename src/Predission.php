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


use Predis\Client;
use Predission\Component\Util;

class Predission implements SessionInterface
{
    /**
     * @var Client $predis
     */
    private $predis;

    private $name = 'Predisson';
    /**
     * @var bool $started
     */
    private $started = false;
    private $token;
    private $config =
        [
            'namespace' => 'session',
            'name' => 'Predisson'
        ];

    public function __construct(Client $predis, $config = [])
    {
        $this->predis = $predis;
        if (!empty($config))
            $this->config = $config;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function generateRandomToken(): string
    {
        return
            implode(
                '-', [
                        Util::createRandomShaToken(), md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'])
                   ]
            );
    }

    /**
     * Starts the session storage.
     *
     * @return bool True if session started
     *
     * @throws \RuntimeException if session fails to start
     * @throws \Exception
     */
    public function start()
    {
        if (!isset($_COOKIE[$this->name])) {
            while ($this->predis->exists($this->token = $this->generateRandomToken())) ;
            setcookie($this->name, $this->token, 0);
        }

        if (!isset($_COOKIE[$this->name])) {
            $_COOKIE[$this->name] = $this->token;
        }

        $this->started = true;
        return true;
    }

    /**
     * Returns the session ID.
     *
     * @return string The session ID
     * @throws \Exception
     */
    public function getId()
    {
        if (!$this->started) {
            $this->start();
        }

        return $_COOKIE[$this->name];
    }

    /**
     * Sets the session ID.
     *
     * @param string $id
     */
    public function setId($id)
    {
        setcookie($this->name, $id);
    }

    /**
     * Returns the session name.
     *
     * @return mixed The session name
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Sets the session name.
     *
     * @param string $name
     */
    public function setName($name) : void
    {
        $this->name = $name;
    }

    public function invalidate()
    {
        $this->predis->del([$this->getId()]);
    }


    public function has($name)
    {
        return $this->predis->hexists($this->getId(), $name);
    }

    public function get($name, $default = null)
    {
        $value = $this->predis->hmget($this->config['namespace'] . ':' . $this->getId(), [$name]);
        if (empty($value[0])) {
            return $default;
        }

        return $value[0];
    }


    public function set(string $name, $value)
    {
        $this->predis->hmset($this->config['namespace'] . ':' . $this->getId(), [$name => $value]);
    }

    /**
     * @param $name
     * @throws \Exception
     */
    public function remove($name)
    {
        $this->predis->hdel($this->getId(), [$name]);
    }

    /**
     * Checks if the session was started.
     *
     * @return bool
     */
    public function isStarted()
    {
        return $this->started;
    }
}
