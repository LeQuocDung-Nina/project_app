import 'package:flutter/material.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';

import '../../constants.dart';
import '../model/product_order_item_model.dart';
import 'product_order_item.dart';



class ProductOrder extends StatelessWidget {
  const ProductOrder({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text("Ghi chú đơn hàng",style: TextStyle(fontSize: 16,fontWeight: FontWeight.w700,color: kTextColor),),
        SizedBox(height: 20,),
        AlignedGridView.count(
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          itemCount: products.length,
          crossAxisCount: 1,
          mainAxisSpacing: 20,
          crossAxisSpacing: 20,
          itemBuilder: (context, index) => ProductOrderItem(
              product_order_item: products[index]),
        ),
      ],
    );
  }
}
