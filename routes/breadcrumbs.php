<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(config('app.name'), route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Home > Dashboard > Admin Management
Breadcrumbs::for('admin-management.admin-list.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Admin Management', route('admin-management.admin-list.index'));
});


// Home > Dashboard > User Management
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('admin-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > User > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});

// Home > Dashboard > Admin Management > Admin > [Admin]
Breadcrumbs::for('admin-management.admin-list.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin-management.admin-list.index');
    $trail->push(ucwords($user->name), route('admin-management.admin-list.show', $user));
});


// Home > Dashboard > User Management > Roles
Breadcrumbs::for('admin-management.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-management.admin-list.index');
    $trail->push('Roles', route('admin-management.roles.index'));
});

// Home > Dashboard > Admin Management > Roles > [Role]
Breadcrumbs::for('admin-management.roles.show', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('admin-management.roles.index');
    $trail->push(ucwords($role->name), route('admin-management.roles.show', $role));
});

// Home > Dashboard > Admin Management > Permission
Breadcrumbs::for('admin-management.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-management.admin-list.index');
    $trail->push('Permissions', route('admin-management.permissions.index'));
});

// Home > Dashboarad > Brand
Breadcrumbs::for('brand', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Brand', route('product-catalogue.brand.index'));
});
// Home > Dashboarad > Category
Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Category', route('product-catalogue.category.index'));
});
// Home > Dashboarad > Subcategory
Breadcrumbs::for('subcategory', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Subcategory', route('product-catalogue.subcategory.index'));
});
Breadcrumbs::for('subsubcategory', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Subsubcategory', route('product-catalogue.subsubcategory.index'));
});
// Home > Dashboarad > Product
Breadcrumbs::for('product', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Product Management', route('product-management.create'));
});
// Home > Dashboarad > Product variant
Breadcrumbs::for('variant', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Product Variant', route('product-management.create'));
});
// Home > Dashboarad > shipping
Breadcrumbs::for('shipping', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('District List', route('shipping.district'));
});
// Home > Dashboarad > order
Breadcrumbs::for('orderlist', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Order List', );
});
Breadcrumbs::for('order', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Order Details', );
});
// Home > Dashboarad > order
Breadcrumbs::for('addorder', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Add Order', );
});
// Home > Dashboarad > order invoice
Breadcrumbs::for('invoice', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Order Invoice', );
});

Breadcrumbs::for('state', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('State/Area List', route('shipping.state'));
});

Breadcrumbs::for('shipping_method', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Shipping Methods', route('shipping.shipping_method'));
});

Breadcrumbs::for('coupon', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Coupon', route('coupon.index'));
});

// Home > Dashboarad > genarel setting
Breadcrumbs::for('setting', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Genarel Settings', );
});
// Home > Dashboarad > genarel setting
Breadcrumbs::for('webitesetting', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Website Settings', );
});