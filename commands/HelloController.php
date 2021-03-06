<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Panel;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

	public function actionPanel()
	{
		$models = Panel::find()->all();
		$count = 0;
		foreach($models as $model)
		{
			$time = $model->date_update + $model->station_time * 3600 - time();
			echo $time;
			if (($time) < 0 || ($model->date_update == NULL))
			{
				$count++;
				$model->delete();
			}
		}
		echo $count;
	}
}
