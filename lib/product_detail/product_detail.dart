import 'package:flutter/material.dart';
import 'package:getwidget/getwidget.dart';
import 'package:smooth_star_rating_null_safety/smooth_star_rating_null_safety.dart';


import '../constants.dart';
import '../models/Product_model.dart';
import 'appbar_product_detail.dart';

class ProductDetail extends StatelessWidget {
  const ProductDetail({Key? key, required this.product}) : super(key: key);
  final Product product;
  final double _rating = 4;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: AppbarProductDetail(),
      ),
      body: SingleChildScrollView(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.start,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Image.asset(product.image,width: double.maxFinite,fit: BoxFit.fill,),
            const SizedBox(height: 25,),
            Padding(
              padding: const EdgeInsets.symmetric(vertical: 0,horizontal: 25),
              child: Column(
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                      Text(product.title,style: TextStyle(fontWeight: FontWeight.w400,fontSize: 23,color: bLtitleColor),),
                      const Icon(Icons.favorite_border,color: priceColor,)
                    ],
                  ),
                  const SizedBox(height: 10,),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                      RichText(
                          text:  TextSpan(
                          text: product.price.toString(),
                          style: TextStyle(color: priceColor,fontSize: 21,),
                          children: const <TextSpan>[
                             TextSpan(text: 'đ'),
                          ],
                        ),
                      ),
                      Row(
                        children: [
                          // SmoothStarRating(
                          //     allowHalfRating: false,
                          //     onRatingChanged: (rating) {
                          //       rating = rating;
                          //     },
                          //     starCount: 5,
                          //     rating: 4,
                          //     size: 20.0,
                          //     // filledIconData: Icons.blur_off,
                          //     // halfFilledIconData: Icons.blur_on,
                          //     color: Colors.amber,
                          //     borderColor: Colors.amber,
                          //     spacing:0.0
                          // ),
                          GFRating(
                            color: Colors.amber,
                            borderColor: Colors.amber,
                            size: 20.0,
                            value: _rating,
                            onChanged: (rating) {
                              rating = rating;
                            },
                          ),
                          const SizedBox(width: 10,),
                          RichText(
                            text:  const TextSpan(
                              text: "562",
                              style: TextStyle(color: greyreview,fontSize: 16,),
                              children:  <TextSpan>[
                                TextSpan(text: 'Reviews'),
                              ],
                            ),
                          ),
                        ],
                      )

                    ],
                  ),
                  const SizedBox(height: 20,),
                  Text(product.description,style: TextStyle(color: desproduct,fontSize: 18,fontWeight: FontWeight.w400,),),
                ],
              ),
            ),
            Container(
              height: 1,
              margin: EdgeInsets.only(top: 20.0),
              color: linegreyColor,
            ),
            Padding(
              padding: const EdgeInsets.symmetric(vertical: 25,horizontal: 25),
              child: Column(
                children: [
                  Row(
                    children: [
                      Container(
                         margin: EdgeInsets.only(right: 10),
                           child: Text("Màu sắc",style: TextStyle(fontSize: 16,fontWeight: FontWeight.w400,color: bLtitleColor),)
                       ),
                      Row(
                         children: [
                           Container(
                             padding: const EdgeInsets.all(5),
                             margin: EdgeInsets.symmetric(horizontal: 10),
                             width: 30,
                             height: 30,
                             decoration: BoxDecoration(
                               color: Colors.black,
                               borderRadius: BorderRadius.circular(20),
                               border: Border.all(color: Colors.deepOrange,width: 2,strokeAlign: 5),
                             ),
                           ),
                           Container(
                             padding: const EdgeInsets.all(10),
                             margin: EdgeInsets.symmetric(horizontal: 10),
                             width: 30,
                             height: 30,
                             decoration: BoxDecoration(
                               color: Colors.amber,
                               borderRadius: BorderRadius.circular(20),
                             ),
                           ),
                           Container(
                             padding: const EdgeInsets.all(10),
                             margin: EdgeInsets.symmetric(horizontal: 10),
                             width: 30,
                             height: 30,
                             decoration: BoxDecoration(
                               color: Colors.deepOrange,
                               borderRadius: BorderRadius.circular(20),
                             ),
                           ),
                           Container(
                             padding: const EdgeInsets.all(10),
                             margin: EdgeInsets.symmetric(horizontal: 10),
                             width: 30,
                             height: 30,
                             decoration: BoxDecoration(
                               color: Colors.tealAccent,
                               borderRadius: BorderRadius.circular(20),
                             ),
                           ),
                         ],
                       ),
                    ],
                  ),
                  SizedBox(height: 25,),
                  Row(
                    children: [
                      Container(
                        width: 60,
                        height: 55,
                        decoration: BoxDecoration(
                          color:bgicon,borderRadius: BorderRadius.circular(15),
                        ),
                        child: Icon(Icons.shopping_cart_sharp,color: priceColor),
                      ),
                      const SizedBox(width: 20,),
                      Expanded(
                        flex: 2,
                        child: ElevatedButton(
                            onPressed: (){},
                            style: ElevatedButton.styleFrom(primary: priceColor,minimumSize: const Size(100, 55)),
                            child: const Center(
                                child: Text("Mua ngay",style: TextStyle(color: Colors.white,fontWeight: FontWeight.w700,fontSize: 17),),
                            ),
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),

          ],
        ),
      ),
    );
  }


}

