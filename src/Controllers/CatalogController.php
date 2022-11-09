<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Catalog;
use App\SessionGuard as Guard;

class CatalogController
{
    public function showAddPage()
    {
        if (!Guard::isUserLoggedIn()) {
			redirect('/errors/404');
		} else {
			$user = Guard::user();
			if ($user->user_id != 1) {
				redirect('/errors/404');
			}
		}
        $data = [
            'error' => session_get_flash('error'),
            'post_url' => '/catalogs',
            'catalogs' => Catalog::all(),
        ];

        render_view('/addCatalog', $data);
    }

    public function create()
    {
        $catalog = new Catalog();
        if ($catalog->fill($_POST)->save(0)) {
            redirect('/catalogs/add');
        }

        $_SESSION['error'] = 'Đã có lỗi xảy ra.';
        redirect('/catalogs/add');
    }

    public function showEditPage($id)
    {
        if (!Guard::isUserLoggedIn()) {
			redirect('/errors/404');
		} else {
			$user = Guard::user();
			if ($user->user_id != 1) {
				redirect('/errors/404');
			}
		}
        $catalog = Catalog::findById($id);
        if (!$catalog) {
            redirect('/errors/404');
        }
        $data = [
            'error' => session_get_flash('error'),
            'post_url' => '/catalogs/edit/' . $id,
            'catalogs' => Catalog::all(),
            'catalog' => $catalog
        ];

        render_view('/editCatalog', $data);
    }

    public function update($id)
    {
        $catalog = Catalog::findById($id);
        $old_catalog = Catalog::findById($id);
        if ($catalog && $catalog->fill($_POST)->save($old_catalog->catalog_id)) {
            redirect('/catalogs/add');
        }

        $_SESSION['error'] = 'Đã có lỗi xảy ra.';
        redirect('/catalogs/edit/' . $id);
    }

    public function delete($id)
    {
        $catalog = Catalog::findById($id);
        if ($catalog) {
            $catalog->delete();
        }

        redirect('/catalogs/add');
    }
}
