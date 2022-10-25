<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Laravel OpenApi Demo Documentation",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="abdukhalilovazim@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Branch",                                  
 *     description="This dropdown belongs to branch"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Cart",                                  
 *     description="This dropdown belongs to Cart"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Customer",                                  
 *     description="This dropdown belongs to Customer"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Debt",                                  
 *     description="This dropdown belongs to Debt"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="District",                                  
 *     description="This dropdown belongs to District"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Invoice",                                  
 *     description="This dropdown belongs to Invoice"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Manufacturer",                                  
 *     description="This dropdown belongs to Manufacturer"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Order",                                  
 *     description="This dropdown belongs to Order"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Organization",                                  
 *     description="This dropdown belongs to Organization"           
 * )                                                                                                                         
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Product",                                  
 *     description="This dropdown belongs to Product"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Product Join Invoice",                                  
 *     description="This dropdown belongs to Product Join Invoice"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Region",                                  
 *     description="This dropdown belongs to Region"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Role",                                  
 *     description="This dropdown belongs to Role"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @OA\Tag(                                                      
 *     name="Treatment Regimen",                                  
 *     description="This dropdown belongs to Treatment Regimen"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * OA\Tag(                                                      
 *     name="Unit",                                  
 *     description="This dropdown belongs to Unit"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * OA\Tag(                                                      
 *     name="User",                                  
 *     description="This dropdown belongs to User"           
 * )                                                             
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}