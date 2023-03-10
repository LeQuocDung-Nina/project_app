import 'package:flutter/material.dart';

import '../../constants.dart';
import '../model/Product_model.dart';
import '../../product_detail/product_detail.dart';

class ProductItem extends StatelessWidget {

  final Product product;
  // final Function press;

  const ProductItem({Key? key, required this.product}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
       Navigator.push(context,
       MaterialPageRoute(builder: (context) => ProductDetail(product: product),),);
      },
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            margin: EdgeInsets.only(bottom: 15),
            decoration: BoxDecoration(
              // color: product.color,
              borderRadius: BorderRadius.circular(16),
            ),
            child: Image.network(product.photo.toString()),
          ),
          Container(
            margin: EdgeInsets.only(bottom: 5),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(product.namevi.toString(),style: TextStyle(fontSize: 15,fontWeight: FontWeight.w400,color: backtitleColor),),
                const Icon(Icons.favorite_border,color: priceColor,),
              ],
            ),
          ),
          Text(product.regularPrice.toString(),style: TextStyle(fontSize: 17,fontWeight: FontWeight.w400,color: priceColor),),

        ],
      ),
    );
  }
}
