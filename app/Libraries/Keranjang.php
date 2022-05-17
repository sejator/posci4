<?php

namespace App\Libraries;

class Keranjang {

    public static function tambah($id = null, array $item)
    {
        $item['total'] = ($item['harga'] * $item['jumlah']);
        $item['diskon'] = 0;
        if (session()->has('keranjang')) {
            // session keranjang sudah ada
            $index = self::_cek_keranjang($id);
            $keranjang = array_values(session('keranjang'));
            if($index == -1){
                // tambah item baru ke keranjang
                array_push($keranjang, $item);
            } else {
                $jumlah = ($keranjang[$index]['jumlah'] + $item['jumlah']);
                // update quantity, cek jika quantity melebihi stok return error
                if($jumlah >= $keranjang[$index]['stok']){
                    return 'error';
                } else {
                    $keranjang[$index]['jumlah'] = $jumlah;
                    // // hitung total
                    $keranjang[$index]['total'] = ($keranjang[$index]['harga'] * $jumlah);
                }
            }
            return session()->set('keranjang', $keranjang);
        } else {
            // session keranjang belum ada
            $keranjang = array($item);
            return session()->set('keranjang', $keranjang);
        }
    }

    public static function ubah($id, $item)
    {
        $index = self::_cek_keranjang($id);
        $keranjang = array_values(session('keranjang'));
        if($index > -1){
            $keranjang[$index]['jumlah'] = $item['jumlah'];
			$keranjang[$index]['diskon'] = $item['diskon'];
			$keranjang[$index]['total'] = $item['total'];
            return session()->set('keranjang', $keranjang);
        }
    }

    public static function hapus($id = null)
    {
        $index = self::_cek_keranjang($id);
        if ($index < 0) {
            return false;
        }
		$keranjang = array_values(session('keranjang'));
		unset($keranjang[$index]); // hapus item dari keranjang
		session()->set('keranjang', $keranjang);
        return true;
    }

    public static function keranjang()
    {
        $session = session('keranjang');
		return is_array($session) ? array_values($session): array();
    }

    public static function sub_total()
    {
        $total = 0;
		$session = session('keranjang');
		$items = is_array($session)? array_values($session): array();
		foreach($items as $item){
			$total += $item['total'];
		}
		return $total;
    }

    private static function _cek_keranjang($id = null)
    {
        // cek array isi keranjang
        $items = array_values(session('keranjang'));
		for($i = 0; $i < count($items); $i++){
			if($items[$i]['id'] == $id){
				return $i;
			}
		}
		return -1;
    }

}