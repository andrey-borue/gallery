<?php

namespace Andrey\GalleryBundle\DataFixtures\ORM;

use Andrey\GalleryBundle\Entity\AlbumMedia;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Andrey\GalleryBundle\Entity\Album;

/**
 * @author Andrey Borue <andrey@borue.ru>
 * @package Andrey\GalleryBundle\DataFixtures\ORM
 */
class LoadUserData implements FixtureInterface
{

    protected static $data = [
        [
            'name' => 'Bali',
            'count' => 5,
            'medias' => [
                ['url' => 'https://lh3.googleusercontent.com/4D9eY1C0x4wHyFmYj-y1p1X_heX8rAAUO2J1ubapHP8p8TB_mYXKnIImh2zltJG243xtFFoXrIf4xYUn-QCs_eYYUvYudmYRJ0YUh9JhLIkLn2yVwHyXookFohn2H2JnWVZmhGDbURe6vXcLDJXO7OaGGZYXRkKJuV-L3h_kUEG7t1NvApw6CTdGd9E3FdKA8n1t4-Si4PR9sbwTxul5hc2yCa7t5R-B4NsjRqklispqDthS9QbQck3C7QAQ4naGI9aTWZ_XB4YE5pVwcSQjqPlWWMk-PlUq_0S4UJQMfZogDyH-dnqAmhlOddihq1evCRQsOPqVb7He_SFgizwk9F3zSPmQIL3TjUm4AZt2lB_IUuoFsHhHug-R3Le7I6x_IxpOQLfzdp9DoCoXiCdnQK_iyS87m85plxc5QUNHFDjbY6clDwnZOgy7yCg0UeJcuIRHbc816PKUGMw0o_NuZpQYinKbJX6sE8MyOj9jXWG-xUehtLI0TwEdbbLiz9FRqAbLUCwLYdqMp2gLtTw3pqKZyQO8xbLf0nHpdbNkoobNtakkPDP2iRmeJpWkcnDBf8DL-Q=w441-h331-no'],
                ['url' => 'https://lh3.googleusercontent.com/RwLJJdaXOEm0DSd1WvS_yA80rxgCTuCR1KoqUe5hkcqaIGdwhOuHOr__QHHHnC4Ptn1nSIhI5LEZfhKHP-OpGxdfAxLFuSCTtepUKGoPm3qP5kTMdLsGTz0QrFVFBdx6eXpK7LKLZLw8-d2r1y6h6INmbx7qYy_g_ic9QeLbRhM9qkhgMB0jZd0RZ5tZr7eebFwzSr2UvE5Xig3NOit0ejVZs8A1nx8gVbY5GKXgENIfhmp8jl_4fB8xx0pqISKDR81YL9RWfqF-muz2EIqLIC1dk0mPg19NN2xPYQfaTqQ1GogxcT_HzJKGrtp2AzQ8jDuBR4aGv84T-uYbRVdkhCYp8xC0Mg_UxNLbZz4jO4OCtFSiqQ2L7I8e_6XVjoH0jXAYGgsbPZxi7ilsVL1f5kIUs8iT87cikyuPQwaU08yeJNY9MhCv4R_Xh9smdTT9ke-1wVNShx6Q46biKwXPY2TKN5m3CCt5EvUpc1xRMsYwhyMpqVWSzNknfu96jBrW_biZjsnpuM1jkEKTFZURSdZqAHerbIR4B73FNLEwfV3UbZdaDSRP5kM1WUKRbUAv7jQB1g=w441-h331-no'],
                ['url' => 'https://lh3.googleusercontent.com/qK8BwsP758XAmfbCuWq042pYdNZrSxYicYyS4ml22VU-V8Pwkqwh9OfniyQBm9AUrABAkpiUwv34r2BKjEPsQEyeu9pihK3Q25scVXpxYvtJ5m-4eu2A23RRE537LMAnMkPuAS_OafNObEK0VCa7UpwoMunFq0rzMjrIJLDa5WfJ70sQRi1K8jtwLHra27QZtnmBPZYVhZzeAhsP2zp85PkjP99ZQYuaMVyGXxZlBfeg-SlPpgvgEE25_j_Y7mKUcha3dXVKKRIM-zohSxJR-d54KHsyl3jFcnxHkvDx-AhNXnR8XNs1vYmT8RWJ3CwANdYxyT02JzIuPP9mHIKvYuM0K3v5YdlBnHNIUq4pX7tV_gOdLzhT3o_lqrvmvNr_9GGu7ns-FlsLX1iknx3A-JUMMJxiKGkPWwoOvxXv00Ot1Y6PYQvlFmuY_ju1A2yXbDNsv4bxuQqafDQ7sZgMB5osiFmv-clE6NijkcYJRgwFwh7mE5sOHJlVWXUoPSsHQvdHNp5cuBcl8nlDe5HEK-lWkVL9aIccjUJlLKRYJmcUw7aZC5T4uAunjwfQtMYwZ56J3A=w441-h331-no'],
            ]
        ],
        [
            'name' => 'Beautiful Bali',
            'count' => 30,
            'medias' => [
                ['url' => 'https://lh3.googleusercontent.com/GHdRkvdUVuveCxyLxSGcvWUiP_vdlYXsOmjZSTtIjaewGetHgL4UzZcuEfrK8Xxxf9alCwT7_95He229ZnklgxYyjSjNEeg8UNFu1-Ywq9-4mTBNCEqR5BOALePiU6_P_iChif09ukXZo4E6zEchhULsfsvjATLi3yOSBXWTdyhmrxzLDV3sA28eBJ4R5O5j2pZiiE1J9SpeP1nJaVcqxv9yLBHqhSilLkPbo2DOtKfuoBPti32zHriUNfEADJGnv4586sz_swrOiLm5sKq3PV1NzPbVyBmy8yXbsBdeVRgwff5ii3Mr35X7fBpQVWDWE5OrtVw7ubhWRmrxL54kzNtuHUPolH3hCejzKZYRMajVHUJLhc01J062RuGDNCPgpxsH16IYm-s5_f4jlt902TYdOcPBKqZdBlctGAgQB2FciZvxvVwSCUQjFwk4ZAPsyuN2xTJotK9QR3b1w61mJFhclsEadEGCC0YuKM-h5ht2fmmolG_8kdtnYIXBc0IgMZDnyDIBznn1wJEwgbV2Y0iNu-rpjRV72MKpBWxdD9k2iSYG29T5wsslVAsBywVDpKLepg=w442-h331-no'],
                ['url' => 'https://lh3.googleusercontent.com/yxDzvgATa7bwBVR6d9oDyR7ucDbSONDHxgbr5SRmAh-xQsp4iOFsPwW_bsz4XN5nEi61cFp0aiwgMw1TGpt4euC9y1turpUf6EYaW03pBlkMfdFMFktdIiAxb_rpaSGi5tRd_FAYxsictpIPxpDhdBh6D5i3IqzYJOt8mSso6MIUXysWEJyuYE8Tn5cUmsTxSx-sqtlp3FS_FRJYWIPH-Uj9nPeuNy02BmVBV9Cq1B4wSR0otOJWHMJ3PqisQM6y_ljcRlf6e8NDm4l4od0XLTpYlAVDU69Y6iaUvotC_ol3E54NvuYld9qeaSr9DH_vsL6uSEImJjBZCut_VvPWXHLwFNIja-xg22XZ6b65FpuEkVOvWXQv3p1NzohdCSNMgUM5l8aEmuy9A89tQRAaeAzND1pl4fSAJ8KmDNVaU4G9TrItkXyj4danzPV2bjL04bVaXb7PqLgpTk41kxkbCoCP0mQiqBcBX12hcSD-9SNyCCGHCPCHzWL5mxff5VOQ_nQTIMYNcKyD_Gz6mstkF4wnfw8XiME--H12gDQ3ZYLqqlBULdCV9NYnfYr7v29WN-8ldw=w441-h331-no'],
            ]
        ],
        [
            'name' => 'Pai Farm',
            'count' => 30,
            'medias' => [
                ['url' => 'https://lh3.googleusercontent.com/V2VzmFdESC4aAc4erBXLESGCJj4id8RBcQHqxIr0Oq6NXWocFmk1cNjupBWkurquCTopWJVGHEWK1akZXjVYK5d6loQglNGKkp-3gYw5KOxQdHH7Nk1VTTSBCoNpBzkPwPVENiSRYrkrIR30esmGs09BFuGOe6cQhbgvuYYoFkaY-YpI5I_vWKxyZgLIkdG1moJWYMHtVmoXqB7N1CG0LyuJJ8ctYtKRZE4B0DTFC9SZRgk3aKn_BMDzoOKwjqA1FDqsGmk6-C-xF4w-EcoBm4P_ys8VTF707jMd0r84AS5L4uJCU05xAHYMBXWtgM9V5a3bTdPqR_vddYMP1RuZw6C1gI1DAqWGYpv5vhgjYqFFrxEg6XjquwW6l64MNVOTXz2K1OF1Da9SuL9tCMErwMpCywVoWyqMFNK1ownUheMrpR-xoQ1us9i7YR8phD12DDtCVUgzuxUoqG7Tn_zMg7f-igTn5KiMw-liRy5sprnv4qlINExrFaRyTWe0ldP4E3OwCoplcKqnZzPodncMEmIEEP8PQqcw4Vac9Xj-MFtnkt2rm-dM75XnwVwwPXbt-fjkGQ=w442-h331-no'],
                ['url' => 'https://lh3.googleusercontent.com/nFx307yYLflHFunA4XOnLa7a8aDH-SoueLO9NVPWZ0x-Bi2Fr5-376Z8Ag3wGPd3sObb0dmmbUPdTDkaaIxsAxDmJzQoT3zfgov0DZ1i0IZu_lXejrUmWp-RYOa4z0sQ-27DJrfulcinQIxqeKhGzs5sOZPJFxAD7Ajt7ArDXKvWuZhVTcl3YkXrZyJaa1iC8XXmgNAZm1jI98npyEwqyxlu7Zh_Fg67_9JfGtU1pN8qvT6jlmDfvq1P3P8MjPEpcF0EEVTUi1b4mL171pkFSXS-ZJTZvfj7czydB2blA8kz9zzCOXqGss6O--sEtPi9afKszqWGdyvN4xR37LkpS23uV0JtxZVT0q0Gzs6HI_Ob8dvplfkxu1FeSx9_w8aw7ZcJIaoTShzzfOvlTVfA_ktM1P-cGd1h9PR8D8VoVoD-j9XJFU2T92bMKPUUgyDmmNkEnGtexD5Ir0ijPMgRBoJbjckiRILcnyqFbf3YVmsIgzMjr6g7JMweUl96lSBmlqZ7Ccuixopy1aiCD-oDej_yzMWaxpAttuYfM8z2Gq5305U3zlvT_GbHgi-7lRkmSHGlxw=w441-h331-no'],
            ]
        ],
        [
            'name' => 'Thailand, Pai',
            'count' => 30,
            'medias' => [
                ['url' => 'https://lh3.googleusercontent.com/FBBCxi9USbdBYGT6Qvy1Kmj0QtizCfXFwG4Bhx9hyEOT-RrFsKjYB4C45-z-eOAZX5MFUVm4I0sNBcbxHwkjiv-pl5fG1Vmh7yvmHydLSFyfXAJBkuAltSoYI93j2QS-pp2QlZWuoRPQ9g1BKgjNPYKOxsntts3UlS-i2JswqyBulmGvvhC32ZROHjzI8j-Y1niEeF_Op004jomz9HHH3EPANfp-YFtDrP6cdMDlQWJMArMT1EdWMIXvzJiQQhfwPqy-j4MukeEvZnRpaqUyd2bBXgkh09-ejcWiOcO2c9onr7I526axsheoglKFCV9QJK42YY8R-ElbNm3LE8wRUu44Sm4MIS_PxXQ0JUiCNR4idUfms1qoWOWn72Tm8iXo9bHyjM-ARMHN0wCsQAsi91hX8c4jiSoGQhFvt53a5Kc7srwmDaPKBdZp-i0F3Wp32UgWz10cGQ86gxY2LbBU1FBlTyLFaUlV4DBcioU6jisLBqJRu12oXTJ-d40DUHVsoFs_YDydLQljc5wOBK_lyr-y-5HyARVxdBaSZzwhD4XINCASGpkymCkmBKzp5wmUhPV8gg=w1956-h1466-no'],
                ['url' => 'https://lh3.googleusercontent.com/El5W6NYME-hWREs9x7ug5FdYOXAh092k3ps1z7jVzgrEiLCqjmMuW_LxZt8tOZ5C-nzeIS3N7grB1zUGVOFQy018nz16kmRILSnMdvsiwl8UgA6SVwh9PFHzLmruc0TWI1RRo4-4H_pF66BsjTijFCoObIMiWygDtWNGDes1l3YgAl_uYYggjRydWHTcYhcTQPaqryhZOcnzU8N-HJrv9hbXP5uIoboMWh1Bk4bL5U3GSa-i6sbUfDjzqT_eBZqWzBnljeyNoMK1DJXkOGMFQWo5UQ1v0B9j7Itg24xX7vQSg9ECQd6AUPv86zfhXAxulHT6KBIvqDZvykxrkrYQjZ142dDwoQBnVQv5_Ty_zozr2n2enEs2qBaHIX9PdURmRgWu04Y1ddx3CGPCCisgZQDMR7R5Gk2eOu5pJQ5LMMVSpNIrCKpiJI-4a1ewtOG6YpVTwyrUhqhR3_Sk0sUTN-WguA_34ubp8lLrtINGVymmczM6WcaiLgiyJjTsELqJnVJb4ShuJJKUbn9xwUIB0t2_BMt0JAz9Hcpp8jcYKH3RF05xtVNfHmsN7wY4WAXAtLpxqg=w397-h298-no'],
            ]
        ],
        [
            'name' => 'Vietnam, Mangrove forest',
            'count' => 30,
            'medias' => [
                ['url' => 'https://lh3.googleusercontent.com/M7Gm_8xsMQCW0VROVe9ZRjIw_w3bqhiwiTtVmYeDCBcR--x2D0L5hd5gXTF9bVO5ttgeQdeDDgO1wCIB62Dk3-Uai-Gd7nypDynbc1nAR9ya-Wyz5tTqP5o2Vtd6qWxjsA3RHEBA7xJYNAGLifV71URzcdHlGc9t1ikke6nv0rx2RfjzF5HAZThtzhPnCe0030a0EnD8FIpm-ZWwNCfp6rJD-Z4eqhrAOpVD8kJooabnU41gCEkijzC9OGjBYjK8PBTfCzcb9MepF37_dKTOoIa5rdAqK6TALdj1iy9_X4wkDdsd52_sFsrCBFMn5hu-3NkC6gOQFLlf3U1gZAQeEvbIBcrolQBHaTWgCvIEF_tuC9Xwe1Weq5gzE8RSGB8WIH7bGhsAg8HndZk88d5AXTcp-d5URZ_LyWAFKJ-R3_9lNMkzxZjQbBa_Wi9VQQm-WfdUIcEVFuEeBLzRBZUIO7zXgJc-4XhVK6VgRCECFFMfuSxZu3_Z7u8tjx-p6qvFaegpLX6cyEDZbxS7AMxlqeqOFLMVsTQ2FzfrmEhoM09wfGyAKQgeHms-zh1EaqeE93GdZQ=w441-h331-no'],
                ['url' => 'https://lh3.googleusercontent.com/xynyhlDgvIjEDqqCkb0XO6ZO1bj6rxat97YWmSrDgLAMoKvE948UR5K4Y9mN-IZGm49dfIW71qQIyw0-VM5UcFlfWiFSWdaIo8pbsKmlXlC99ezvdahoxWSpj7NxC1uixJNbBthKlbuzvVLfuvr6RMHdUnGvkas05lB0ltzzVJHvq_8gjDwMalF9qV-hGzFw2SwMNKfCz11NyBrMdMtrW1VKU8R4QFNqZt_-sUMkODsJgdQmKnhpX9SPT_80DEVvZq0lLkIsssf60-9qsjditat1rCAY4GPM68QsGbeEjK03MU_dGhaFsdGibnIHtTHzR86c3nVrDrOYoUf-7G2M_uWCpKDlVfYbsABLkUwLvoSfzTZLpxJAal9Z7zMMDa_JDaL4vDWI7BKtf29cha8ASF5dIBY4Cc2v2QQrQ0sQJg3whGFvbnxROi9h3erEtZTztpvDL1EZfPf70ya-mxWDghNOpPNCmgMnOK9ZgovADI4YKV3JBTkrlgBaKRkDzGokuS7RImY5-AZWYHcRBxsh_aM_HEg7l9EgR5OpYWmoNvnDP_iuBwVN4lfo664CaNMX1OkZlA=w441-h331-no'],
            ]
        ]
    ];


    public function load(ObjectManager $manager)
    {

        foreach (self::$data as $row) {
            $album = new Album();
            $album->setName($row['name']);
            $manager->persist($album);

            $i = 0;
            while (++$i <= $row['count']) {
                $m = next($row['medias']);
                if (!$m) {
                    $m = reset($row['medias']);
                }
                $media = new AlbumMedia();
                $media
                    ->setUrl($m['url'])
                    ->setAlbum($album);
                $manager->persist($media);
            }

            $manager->flush();
            $manager->clear();

        }


    }
}
