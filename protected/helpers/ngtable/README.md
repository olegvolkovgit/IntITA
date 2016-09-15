## Basic usage ##

```php
    $requestParams = $_GET;
    $ngTable = new NgTableAdapter('UserContentManager', $requestParams);
    $result = $ngTable->getData();
    echo json_encode($result);
```

## NgTableAdapter ##

#### Constructor ####

```php
    new NgTableAdapter($activeRecord, $requestParams);
```
`$activeRecord` - string | CActiveRecord
Name of class inherited from CActiveRecord or CActiveRecord model class;
e.g. 'User' or User::model();

`$requestParams` - array
An array matched with ngTable param.url() object, typical - $_GET.

Current support:
```
[
    page => '0'
    count => '10'
    filter => 
        [
            'fieldName' => 'fieldValue',
            'relationName.relatedModelFieldName' => 'fieldValue'
        ]
    sorting => 
        [
            'fieldName' => 'asc',
            'relationName.relatedModelFieldName' => 'desc'        
        ]
    extraParams => 
        [
            'fieldName' => 'fieldValue',
            'relationName.relatedModelFieldName' => 'fieldValue'        
        ]
]
```

`page` - integer
Number of current page to select.
_If page not specified you will receive records without any limitation_

`count` - integer
Rows count per page.

`filter` - array
Filter params form ngTable, this add `LIKE` condition in where clause.
Several conditions will be concat with `AND`.

`sorting` - array
Sorting condition for query

`extraParams` - array
Additional conditions which not provided by ngTable, but you can add it as additional condition to limit request by some condition.
Adds to query condition with '=' compare operator.
Multiply conditions concat with `AND`


#### public function getData() ####

Returns associative array with models according to params.
```
[
    'count' => 100
    'rows' => []
]
```

`count` - integer
Total number of rows.

`rows` - array
An array of models transformed to associative array 


#### public function mergeCriteriaWith($criteria) ####

`$criteria` - CDbCriteria
Additional condition which can be added to query criteria.
Call this method before getData()



## INgTableProvider ##
The interface describes methods which will be used to get different information from model to build query.
Default implementation - class NgTableProviderDefault;

This interface extends IBehavior and its implementation should implements all IBehavior methods directly or extends CActiveRecordBehavior, CModelBehavior or CBehavior

Example:
```
class NgTableProviderDefault extends CActiveRecordBehavior implements INgTableProvider {
    ...
}
```

#### public function getAttributes() ####
Function should return an array of model's attributes name to be used in select query **if the model is used directly in request (not related model)**.

_Default implementation : return an array of model's attributes name._
_Usecase: to limit returned fields, e.g. password field_


#### public function getRelationAttributes() ####
Function should return an array of model's attributes name to be used in select query **if the model is used in request as related model**.

_Default implementation : return an array of model's attributes name._
_Usecase: to limit returned fields of related model, e.g. password field_


#### public function getSearchCriteria($fieldName, $value, $alias='t') ####
`$fieldName` - string
Field (attribute) name

`$value` - string
Field's value

`$alias` - string
Table alias; should be null or 't' for direct model and relation name for related mode.

Function should return a CDbCriteria with 'LIKE' condition for query for filter params.
_Default implementation : return (new CDbCriteria())->addSearchCondition("$alias.$fieldName", $value);_
_Usecase: to implement non-standard search query, e.g. 'fullName' in StudentReg_

#### public function getOrderStatement($fieldName, $direction, $alias='t') ####
`$fieldName` - string
Field (attribute) name

`$direction` - string
'ASC'|'DESC'

`$alias` - string
Table alias; should be null or 't' for direct model and relation name for related mode.

Function should return an array with order statement for `$fieldName`
_Default implementation : return \["$alias.$fieldName $direction"];_
_Usecase: to implement non-standard order statement, e.g. 'fullName' in StudentReg model_

#### public function getAdditionalFields() ####
Function should return an array with additional model's properties which will be added to result array.

_Default implementation: returns an empty array_
_Usecase: to add some extra data from model to result array, e.g. 'fullName' in StudentReg model_


#### public function getRelations() ####
Function should return an array with relations to be loaded with query.

_Default implementation: return $this->owner->relations()_
_Usecase: to limit relations in request_


## Using INgTableProvider implementation ##

To use specific INgTableProvider in model you should attach it as behavior to a model.
Behavior's name should be 'ngTable'.

You can attach behavior in class:
```
class StudentReg extends CActiveRecord {

    ...
    
    public function behaviors() {
        return [
            'ngTable' => [
                'class' => 'NgTableProviderStudentReg'
            ]
        ];
    }
    
    ...
    
}
```

Or immediately before creating NgTableInstance:
```
    ...
    $model = SomeModel::model();
    $model->attachBehavior(['class' => 'NgTableProviderSomeClass'])
    $ngTable = new NgTableAdapter($model, $requestParams);
    ...
```

If 'ngTable' behavior is missed in model, the 'NgTableProviderDefault' class will be attached to the model in 'NgTableAdapter' instance.
All behaviors, attached by 'NgTableAdapter' will be detached in 'NgTableAdapter' destructor.

If you have some model with defined 'ngTable' behavior, but in particular case need to redefine the behavior to another, you can just attach another behavior before creating 'NgTableAdapter' as shown in last example.