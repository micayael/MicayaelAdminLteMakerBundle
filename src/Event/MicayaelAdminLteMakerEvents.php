<?php

namespace Micayael\AdminLteMakerBundle\Event;

final class MicayaelAdminLteMakerEvents
{
    /**
     * Se invoca antes de realizar el persist del entity
     *
     * @Event("Micayael\AdminLteMakerBundle\Event\MicayaelAdminLteMakerCrudEvent")
     */
    const MICAYAEL_ADMIN_LTE_MAKER_NEW_PRE_PERSIST = 'admin_lte_maker.new.pre_persist';

    /**
     * Se invoca antes de realizar el persist del entity
     *
     * @Event("Micayael\AdminLteMakerBundle\Event\MicayaelAdminLteMakerCrudEvent")
     */
    const MICAYAEL_ADMIN_LTE_MAKER_EDIT_PRE_UPDATE = 'admin_lte_maker.edit.pre_update';

    /**
     * Se invoca antes de realizar el persist del entity
     *
     * @Event("Micayael\AdminLteMakerBundle\Event\MicayaelAdminLteMakerCrudEvent")
     */
    const MICAYAEL_ADMIN_LTE_MAKER_DELETE_PRE_DELETE = 'admin_lte_maker.delete.pre_delete';
}
