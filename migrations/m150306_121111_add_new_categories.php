<?php

use yii\db\Schema;
use yii\db\Migration;

class m150306_121111_add_new_categories extends Migration
{
    private $_category     = 'category';
    private $_top_category = 'top_category';

    public function safeUp()
    {
        $this->insert($this->_top_category, ['id' => 1, 'title' => 'Film']);
        $this->insert($this->_category, ['id' => 16, 'parent_id' => 1, 'title' => 'DVD-film og Blu-ray']);
        $this->insert($this->_category, ['id' => 17, 'parent_id' => 1, 'title' => 'Videofilm']);

        $this->insert($this->_top_category, ['id' => 2, 'title' => 'Musik cd, lp og bånd']);
        $this->insert($this->_category, ['id' => 18, 'parent_id' => 2, 'title' => 'Lp']);
        $this->insert($this->_category, ['id' => 19, 'parent_id' => 2, 'title' => 'Music CD']);

        $this->insert($this->_top_category, ['id' => 3, 'title' => 'Hi-fi og tilbehør']);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 6]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 7]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 8]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 9]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 3]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 10]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 11]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 12]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 13]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 14]);
        $this->update($this->_category, ['parent_id' => 3], ['id' => 15]);

        $this->insert($this->_top_category, ['id' => 4, 'title' => 'Tv og tilbehør']);
        $this->insert($this->_category, ['id' => 20, 'parent_id' => 4, 'title' => 'Tilbehør til tv']);
        $this->insert($this->_category, ['id' => 21, 'parent_id' => 4, 'title' => 'Tv - 22" - 28"']);
        $this->insert($this->_category, ['id' => 22, 'parent_id' => 4, 'title' => 'Tv - 29" - 41"']);
        $this->insert($this->_category, ['id' => 23, 'parent_id' => 4, 'title' => 'Tv over 41"']);
        $this->insert($this->_category, ['id' => 24, 'parent_id' => 4, 'title' => 'Tv - 15" - 21"']);
        $this->insert($this->_category, ['id' => 25, 'parent_id' => 4, 'title' => 'Andre tv']);
        $this->insert($this->_category, ['id' => 26, 'parent_id' => 4, 'title' => 'Tv under 15"']);

        $this->insert($this->_top_category, ['id' => 5, 'title' => 'Fotoudstyr']);
        $this->insert($this->_category, ['id' => 27, 'parent_id' => 5, 'title' => 'Andet fotoudstyr og tilbehør']);
        $this->insert($this->_category, ['id' => 28, 'parent_id' => 5, 'title' => 'Objektiver/Linser']);
        $this->insert($this->_category, ['id' => 29, 'parent_id' => 5, 'title' => 'Blitz']);
        $this->insert($this->_category, ['id' => 30, 'parent_id' => 5, 'title' => 'Hukommelseskort']);
        $this->insert($this->_category, ['id' => 31, 'parent_id' => 5, 'title' => 'Mørkekammerudstyr']);

        $this->insert($this->_top_category, ['id' => 6, 'title' => 'Dvd-afspillere, videomaskiner, projektorer og tilbehør']);
        $this->insert($this->_category, ['id' => 32, 'parent_id' => 6, 'title' => 'Dvd-afspillere m.m.']);
        $this->insert($this->_category, ['id' => 33, 'parent_id' => 6, 'title' => 'Projektorer og tilbehør']);
        $this->insert($this->_category, ['id' => 34, 'parent_id' => 6, 'title' => 'DVD- og harddiskoptagere']);
        $this->insert($this->_category, ['id' => 35, 'parent_id' => 6, 'title' => 'Videomaskiner']);

        $this->insert($this->_top_category, ['id' => 7, 'title' => 'Videokameraer, smalfilmsudstyr og kikkerter']);
        $this->insert($this->_category, ['id' => 36, 'parent_id' => 7, 'title' => 'Videokameraer og -udstyr']);
        $this->insert($this->_category, ['id' => 37, 'parent_id' => 7, 'title' => 'Kikkerter m.v.']);
        $this->insert($this->_category, ['id' => 38, 'parent_id' => 7, 'title' => 'Smalfilmsudstyr']);

        $this->insert($this->_top_category, ['id' => 8, 'title' => 'Digitale kameraer']);
        $this->insert($this->_category, ['id' => 39, 'parent_id' => 8, 'title' => 'Canon']);
        $this->insert($this->_category, ['id' => 40, 'parent_id' => 8, 'title' => 'Andre digitale kameraer']);
        $this->insert($this->_category, ['id' => 41, 'parent_id' => 8, 'title' => 'Sony']);
        $this->insert($this->_category, ['id' => 42, 'parent_id' => 8, 'title' => 'Nikon']);
        $this->insert($this->_category, ['id' => 43, 'parent_id' => 8, 'title' => 'Olympus']);
        $this->insert($this->_category, ['id' => 44, 'parent_id' => 8, 'title' => 'HP']);
        $this->insert($this->_category, ['id' => 45, 'parent_id' => 8, 'title' => 'Minolta']);

        $this->insert($this->_top_category, ['id' => 9, 'title' => 'Hi-fi surround og tilbehør']);
        $this->insert($this->_category, ['id' => 46, 'parent_id' => 9, 'title' => 'Surroundhøjttalere og -subwoofere']);
        $this->insert($this->_category, ['id' => 47, 'parent_id' => 9, 'title' => 'Surroundsystemer']);
        $this->insert($this->_category, ['id' => 48, 'parent_id' => 9, 'title' => 'Surroundforstærkere']);

        $this->insert($this->_top_category, ['id' => 10, 'title' => 'Paraboler, antenner og tilbehør']);
        $this->insert($this->_category, ['id' => 49, 'parent_id' => 10, 'title' => 'Digitale receivere']);
        $this->insert($this->_category, ['id' => 50, 'parent_id' => 10, 'title' => 'Andet udstyr']);
        $this->insert($this->_category, ['id' => 51, 'parent_id' => 10, 'title' => 'Parabolskærme og -skåle']);
        $this->insert($this->_category, ['id' => 52, 'parent_id' => 10, 'title' => 'Analoge receivere']);

        $this->insert($this->_top_category, ['id' => 11, 'title' => 'Analoge kameraer']);
        $this->insert($this->_category, ['id' => 53, 'parent_id' => 11, 'title' => 'Andre analoge kameraer']);
        $this->insert($this->_category, ['id' => 54, 'parent_id' => 11, 'title' => 'Canon']);
        $this->insert($this->_category, ['id' => 55, 'parent_id' => 11, 'title' => 'Nikon']);
        $this->insert($this->_category, ['id' => 56, 'parent_id' => 11, 'title' => 'Minolta']);
        $this->insert($this->_category, ['id' => 57, 'parent_id' => 11, 'title' => 'Olympus']);
        $this->insert($this->_category, ['id' => 58, 'parent_id' => 11, 'title' => 'Pentax']);
    }

    public function safeDown()
    {
        $this->delete($this->_top_category, 'id = 1');
        $this->delete($this->_category, 'id = 16');
        $this->delete($this->_category, 'id = 17');

        $this->delete($this->_top_category, 'id = 2');
        $this->delete($this->_category, 'id = 18');
        $this->delete($this->_category, 'id = 19');

        $this->delete($this->_top_category, 'id = 3');
        $this->update($this->_category, ['parent_id' => 0], ['id' => 6]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 7]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 8]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 9]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 3]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 10]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 11]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 12]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 13]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 14]);
        $this->update($this->_category, ['parent_id' => 0], ['id' => 15]);

        $this->delete($this->_top_category, 'id = 4');
        $this->delete($this->_category, 'id = 20');
        $this->delete($this->_category, 'id = 21');
        $this->delete($this->_category, 'id = 22');
        $this->delete($this->_category, 'id = 23');
        $this->delete($this->_category, 'id = 24');
        $this->delete($this->_category, 'id = 25');
        $this->delete($this->_category, 'id = 26');

        $this->delete($this->_top_category, 'id = 5');
        $this->delete($this->_category, 'id = 27');
        $this->delete($this->_category, 'id = 28');
        $this->delete($this->_category, 'id = 29');
        $this->delete($this->_category, 'id = 30');
        $this->delete($this->_category, 'id = 31');

        $this->delete($this->_top_category, 'id = 6');
        $this->delete($this->_category, 'id = 32');
        $this->delete($this->_category, 'id = 33');
        $this->delete($this->_category, 'id = 34');
        $this->delete($this->_category, 'id = 35');

        $this->delete($this->_top_category, 'id = 7');
        $this->delete($this->_category, 'id = 36');
        $this->delete($this->_category, 'id = 37');
        $this->delete($this->_category, 'id = 38');

        $this->delete($this->_top_category, 'id = 8');
        $this->delete($this->_category, 'id = 39');
        $this->delete($this->_category, 'id = 40');
        $this->delete($this->_category, 'id = 41');
        $this->delete($this->_category, 'id = 42');
        $this->delete($this->_category, 'id = 43');
        $this->delete($this->_category, 'id = 44');
        $this->delete($this->_category, 'id = 45');

        $this->delete($this->_top_category, 'id = 9');
        $this->delete($this->_category, 'id = 46');
        $this->delete($this->_category, 'id = 47');
        $this->delete($this->_category, 'id = 48');

        $this->delete($this->_top_category, 'id = 10');
        $this->delete($this->_category, 'id = 49');
        $this->delete($this->_category, 'id = 50');
        $this->delete($this->_category, 'id = 51');
        $this->delete($this->_category, 'id = 52');

        $this->delete($this->_top_category, 'id = 11');
        $this->delete($this->_category, 'id = 53');
        $this->delete($this->_category, 'id = 54');
        $this->delete($this->_category, 'id = 55');
        $this->delete($this->_category, 'id = 56');
        $this->delete($this->_category, 'id = 57');
        $this->delete($this->_category, 'id = 58');
    }
}
