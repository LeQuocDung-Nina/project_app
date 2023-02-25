import 'package:flutter/material.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';

import '../constants.dart';
import '../filter/filter_product.dart';
import '../homepages/wedget/product.dart';
import '../homepages/model/Product_model.dart';

class ProductNes extends StatelessWidget {
  const ProductNes({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(),
      body: SingleChildScrollView(
        child: Column(
          children: [
            Container(
              padding: EdgeInsets.symmetric(vertical: 0,horizontal: 20),
              child: Row(
                children: [
                  const Text("Hàng mới về",style: TextStyle(fontSize: 19,fontWeight: FontWeight.w700,color: bLtitleColor),),
                  const Spacer(),
                  Image.asset("assets/images/arrange.png"),
                  const SizedBox(width: 15,),
                  GestureDetector(
                    onTap: () {
                      Navigator.push(context, MaterialPageRoute(builder: (context) => FilterProduct(),));
                    },
                      child: Image.asset("assets/images/filter.png")
                  ),
                ],
              ),
            ),
            Container(
              height: 1,
              margin: EdgeInsets.symmetric(vertical: 20.0),
              color: linegreyColor,
            ),
            Container(
              padding: EdgeInsets.symmetric(vertical: 0,horizontal: 20),
              // child: AlignedGridView.count(
              //   shrinkWrap: true,
              //   physics: const NeverScrollableScrollPhysics(),
              //   // itemCount: 6,
              //   itemCount: products.length,
              //   crossAxisCount: 2,
              //   mainAxisSpacing: 20,
              //   crossAxisSpacing: 20,
              //   itemBuilder: (context, index) => ProductItem(
              //       product: products[index]),
              // ),
            )
          ],
        ),
      ),
    );
  }
}
