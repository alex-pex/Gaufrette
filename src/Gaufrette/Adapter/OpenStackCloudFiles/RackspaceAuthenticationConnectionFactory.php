<?php
/**
 * Created by PhpStorm.
 * User: cwarner
 * Date: 10/1/13
 * Time: 4:28 PM
 */

namespace Gaufrette\Adapter\OpenStackCloudFiles;


use OpenCloud\OpenStack;
use Gaufrette\Adapter\OpenStackCloudFiles\ConnectionFactoryInterface;
use OpenCloud\Common\Base;
use OpenCloud\Rackspace;

/**
 * Class RackspaceAuthenticationConnectionFactory
 * @package Gaufrette\Adapter\OpenStackCloudFiles
 * @author Chris Warner <cdw.lighting@gmail.com>
 */
class RackspaceAuthenticationConnectionFactory extends BaseOpenStackAuthenticationFactory implements ConnectionFactoryInterface
{

    /**
     * @return Rackspace
     */
    public function create()
    {
        if (null === $this->authenciationService)
        {
            $this->authenciationService = new Rackspace($this->url, array($this->username, $this->apikey));
            $this->authenciationService->authenticate();


        } elseif ($this->authenciationService->expired()) {
            $this->authenciationService->authenticate();
        }

        return $this->authenciationService;
    }

} 
