<?php

use yii\db\Migration;

/**
 * Handles the creation of table `holidays`.
 */
class m180909_165838_create_holidays_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('holidays', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull()->comment('Id сотрудника'),
            'date_start' => $this->date()->notNull()->comment('Дата начала отпуска'),
            'date_end'   => $this->date()->notNull()->comment('Дата окончания отпуска'),
            'approved'   => $this->tinyInteger()->notNull()->defaultValue(0)->comment('Подтверждение отпуска'),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('user_id_i','holidays','user_id');
        $this->addForeignKey('user_id_fk', 'holidays', 'user_id', 'users', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('holidays');
    }
}
