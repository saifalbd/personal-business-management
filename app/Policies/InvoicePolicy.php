<?php

namespace App\Policies;

use App\User;
use App\Model\Invoice;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the invoice.
     *
     * @param User $user
     * @param Invoice $invoice
     * @return mixed
     */
    public function vendor(Invoice $invoice)
    {
        return true;

        return $invoice->vendor??false;

    }


    /**
     * Determine whether the user can view the invoice.
     *
     * @param User $user
     * @param Invoice $invoice
     * @return mixed
     */
    public function view(User $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can create invoices.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the invoice.
     *
     * @param User $user
     * @param Invoice $invoice
     * @return mixed
     */
    public function update(User $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can delete the invoice.
     *
     * @param User $user
     * @param Invoice $invoice
     * @return mixed
     */
    public function delete(User $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can restore the invoice.
     *
     * @param User $user
     * @param Invoice $invoice
     * @return mixed
     */
    public function restore(User $user, Invoice $invoice)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the invoice.
     *
     * @param User $user
     * @param Invoice $invoice
     * @return mixed
     */
    public function forceDelete(User $user, Invoice $invoice)
    {
        //
    }
}
