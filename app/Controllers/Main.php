<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Main extends BaseController
{
    public function index()
    {
        return view('layout/home');
    }

    public function ambilDataProvinsi()
    {
        if ($this->request->isAJAX()) {
            $cariData = $this->request->getGet('search');

            $dataProvinsi = $this->db->table('wilayah_provinsi')->like('nama', $cariData)->get();

            if ($dataProvinsi->getNumRows() > 0) {
                $list = [];
                $key = 0;

                foreach ($dataProvinsi->getResultArray() as $row) :
                    $list[$key]['id'] = $row['id'];
                    $list[$key]['text'] = $row['nama'];
                    $key++;
                endforeach;

                echo json_encode($list);
            }
        }
    }

    public function ambilKabupatenKota()
    {
        if ($this->request->isAJAX()) {
            $provinsi = $this->request->getVar('provinsi');

            $dataKabupaten = $this->db->table('wilayah_kabupaten')->where('provinsi_id', $provinsi)->get();

            $isiData = "";

            foreach ($dataKabupaten->getResultArray() as $row) :
                $isiData .= '<option value="'.$row['id'].'">'.$row['nama'].'</option>';
            endforeach;

            $msg = [
                'data' => $isiData
            ];

            echo json_encode($msg);
        }
    }

    public function ambilKecamatan()
    {
        if ($this->request->isAJAX()) {
            $kecamatan = $this->request->getVar('kecamatan');

            $dataKecamatan = $this->db->table('wilayah_kecamatan')->where('kabupaten_id', $kecamatan)->get();

            $isiData = "";

            foreach ($dataKecamatan->getResultArray() as $row) :
                $isiData .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isiData
            ];

            echo json_encode($msg);
        }
    }

    public function ambilDesa()
    {
        if ($this->request->isAJAX()) {
            $desa = $this->request->getVar('desa');

            $dataDesa = $this->db->table('wilayah_desa')->where('kecamatan_id', $desa)->get();

            $isiData = "";

            foreach ($dataDesa->getResultArray() as $row) :
                $isiData .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isiData
            ];

            echo json_encode($msg);
        }
    }
}
