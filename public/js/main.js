const dropdownCatalog = $("#dropdown-catalog");
const dropdownCatalogTitle = $("#dropdown-toggle-catalog");
const dropdownCatalogContent = $("#dropdown-menu-catalog");

dropdownCatalog.hover(function () {
    dropdownCatalogTitle.addClass("show");
    dropdownCatalogTitle.prop("aria-expanded", "true");
    dropdownCatalogContent.addClass("show");
}, function () {
    dropdownCatalogTitle.removeClass("show");
    dropdownCatalogTitle.prop("aria-expanded", "false");
    dropdownCatalogContent.removeClass("show");
})

const dropdownUser = $("#dropdown-user");
const dropdownUserTitle = $("#dropdown-toggle-user");
const dropdownUserContent = $("#dropdown-menu-user");

dropdownUser.hover(function () {
    dropdownUserTitle.addClass("show");
    dropdownUserTitle.prop("aria-expanded", "true");
    dropdownUserContent.addClass("show");
    
}, function () {
    dropdownUserTitle.removeClass("show");
    dropdownUserTitle.prop("aria-expanded", "false");
    dropdownUserContent.removeClass("show");
})

const dropdownAdmin = $("#dropdown-admin");
const dropdownAdminTitle = $("#dropdown-toggle-admin");
const dropdownAdminContent = $("#dropdown-menu-admin");

dropdownAdmin.hover(function () {
    dropdownAdminTitle.addClass("show");
    dropdownAdminTitle.prop("aria-expanded", "true");
    dropdownAdminContent.addClass("show");
    
}, function () {
    dropdownAdminTitle.removeClass("show");
    dropdownAdminTitle.prop("aria-expanded", "false");
    dropdownAdminContent.removeClass("show");
})

$("#btnModal").trigger("click");