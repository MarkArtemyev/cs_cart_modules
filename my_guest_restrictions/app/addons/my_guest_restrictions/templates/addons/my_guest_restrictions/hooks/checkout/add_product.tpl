{* Файл templates/addons/my_guest_restrictions/hooks/checkout/add_product.tpl *}

{if !$auth.user_id}
    <div class="my-guest-restrictions-promo">
        {__("registration_promo_text")}
    </div>
{/if}