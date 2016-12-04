<?php

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table="article";//指定表的名称
    protected $primaryKey = 'article_id';//指定表的主键、否则会默认为id
    public $timestamps = false;//忽略插入框架自动添加的create_at、update_at两个时间戳
    public $guarded = [];//这个表示不可以被赋值的字段，空则是所有都可以被赋值
}
