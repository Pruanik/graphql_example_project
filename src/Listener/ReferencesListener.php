<?php

declare(strict_types=1);

namespace App\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ReferencesListener
 */
class ReferencesListener extends \Gedmo\References\ReferencesListener
{
    private ContainerInterface $container;

    protected array $managers = [
        'document' => 'doctrine_mongodb.odm.document_manager',
        'entity'   => 'doctrine.orm.default_entity_manager',
    ];

    /**
     * @param ContainerInterface $container
     * @param array              $managers
     */
    public function __construct(ContainerInterface $container, array $managers = array())
    {
        $this->container = $container;
        parent::__construct($managers);
    }

    /**
     * @param $type
     * @return object
     */
    public function getManager($type)
    {
        return $this->container->get($this->managers[$type]);
    }
}