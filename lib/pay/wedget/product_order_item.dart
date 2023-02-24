import 'package:flutter/material.dart';

import '../../constants.dart';
import '../model/product_order_item_model.dart';

class ProductOrderItem extends StatelessWidget {
  const ProductOrderItem({Key? key, required this.product_order_item}) : super(key: key);

  final Product  product_order_item;

  @override
  Widget build(BuildContext context) {
    return Row(
      children: [
        Expanded(
          flex: 1,
          child: ClipRRect(
            borderRadius: BorderRadius.circular(10),
            child: Image.asset(product_order_item.image,width: double.maxFinite,height: 90, fit: BoxFit.fill,),
          ),
        ),
        const SizedBox(width: 15,),
        Expanded(
          flex: 3,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              Text(product_order_item.title,style: TextStyle(color: backtitleColor,fontSize: 15),),
              SizedBox(height: 10,),
              RichText(text: TextSpan(
                  style: TextStyle(color: priceColor,fontSize: 18),
                  children: [
                    TextSpan(text: product_order_item.price.toString(),),
                    TextSpan(text: "đ",),
                  ]
              )),
              SizedBox(height: 10,),
              RichText(text: const TextSpan(
                  style: TextStyle(color: bLtitle2Color,fontSize: 15),
                  children: [
                    TextSpan(text: "x",),
                    TextSpan(text: "1",),
                  ]
              )),
            ],
          ),
        ),
      ],
    );
  }
}
