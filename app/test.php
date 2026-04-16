<?php
echo "<pre>";
$data = [
    ['category'  => 'Bedroom','attribute' => 'bedsize','option' => 'king'],
    ['category'  => 'Bedroom','attribute' => 'bedsize','option' => 'queen'],
    ['category'  => 'Bedroom','attribute' => 'bedsize','option' => 'twin'],
    ['category'  => 'Bedroom','attribute' => 'bedsize','option' => 'cal. king'],
    ['category'  => 'Bedroom','attribute' => 'color','option' => 'brown'],
    ['category'  => 'Bedroom','attribute' => 'color','option' => 'pink'],
    ['category'  => 'Bedroom','attribute' => 'color','option' => 'white'],
    ['category'  => 'Bedroom','attribute' => 'color','option' => 'black'],
    ['category'  => 'Livingroom','attribute' => 'Sofa','option' => 'L-shaped'],
    ['category'  => 'Livingroom','attribute' => 'Sofa','option' => 'U-shaped'],
    ['category'  => 'Livingroom','attribute' => 'Sofa','option' => 'Sectional'],
    ['category'  => 'Livingroom','attribute' => 'Sofa','option' => 'Sleeper'],
    ['category'  => 'Livingroom','attribute' => 'Chair','option' => 'Recliner'],
    ['category'  => 'Livingroom','attribute' => 'Chair','option' => 'Armchair'],
    ['category'  => 'Livingroom','attribute' => 'Chair','option' => 'Accent Chair'],
    ['category'  => 'Livingroom','attribute' => 'Chair','option' => 'Rocking Chair'],
    ['category'  => 'Dinning Room','attribute' => 'Table','option' => 'Square'],
    ['category'  => 'Dinning Room','attribute' => 'Table','option' => 'Round'],
    ['category'  => 'Dinning Room','attribute' => 'Table','option' => 'Rectangular'],
    ['category'  => 'Dinning Room','attribute' => 'Table','option' => 'Oval'],
    ['category'  => 'Dinning Room','attribute' => 'Chair','option' => 'Height Chair'],
    ['category'  => 'Dinning Room','attribute' => 'Chair','option' => 'Armchair'],
    ['category'  => 'Dinning Room','attribute' => 'Chair','option' => 'Accent Chair'],
    ['category'  => 'Dinning Room','attribute' => 'Chair','option' => 'Armless Chair']    
];

$final = [];
 
foreach ($data as $row) {
    $category = $row['category'];
    $attribute = $row['attribute'];
    $option = $row['option'];

    $final[$category]['category'] = $category;
 
    $final[$category]['attributes']['attribute'] = $attribute;
 
    $final[$category]['attributes']['options'][] = ['option' => $option];
}


print_r($final);
?>
