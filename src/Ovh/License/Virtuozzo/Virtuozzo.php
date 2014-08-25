<?php
/**
 * Copyright 2013 Stéphane Depierrepont (aka Toorop)
 *
 * Authors :
 *  - Stéphane Depierrepont (aka Toorop)
 *  - Florian Jensen (aka flosoft) : https://github.com/flosoft
 *  - Gillardeau Thibaut (aka Thibautg16) 
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * http://www.apache.org/licenses/LICENSE-2.0.txt
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Ovh\License\Virtuozzo;


use Ovh\Common\Exception\NotImplementedYetException;
use Ovh\Common\Exception\NotImplementedYetByOvhException;

use Ovh\Common\Ovh;
use Ovh\License\Virtuozzo\VirtuozzoClient;
use Ovh\Common\Task;


class Virtuozzo
{
	private $domain = null;
	private static $VirtuozzoClient = null;

	/**
	 * @param string $domain
	 */
	public function __construct($domain)
	{
		$this->setDomain($domain);
	}


	/**
	 * Return Virtuozzo client
	 *
	 * @return null|VirtuozzoClient
	 */
	private static function getClient()
	{
		if (!self::$VirtuozzoClient instanceof VirtuozzoClient){
			self::$VirtuozzoClient=new VirtuozzoClient();
		};
		return self::$VirtuozzoClient;
	}

	/**
	 * Set domain
	 *
	 * @param string $domain
	 */
	public function setDomain($domain)
	{
		$this->domain = $domain;
	}

	/**
	 * Get domain
	 *
	 * @return null | string domain
	 */
	public function getDomain()
	{
		return $this->domain;
	}



	###
	# Mains methods from OVH Rest API
	##

	/**
	 *  Get Orderable Versions
	 *
	 *  @param  ip - Ip on which to placel license
	 *  @return object
	 *
	*/
	public function getOrderableVersions($ip){
        return json_decode(self::getClient()->getProperties($this->getDomain(),$ip));
    }
	    
    /**
	 *  Get Properties of supplied licence
	 *
	 *  @return object
	 *
	*/
	public function getProperties(){
        return json_decode(self::getClient()->getProperties($this->getDomain()));
    }
}