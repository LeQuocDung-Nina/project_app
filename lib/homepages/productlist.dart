import 'package:demo1/controller/home_controller.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';
import 'package:get/get.dart';

import '../product/product_new.dart';
import 'package:flutter/material.dart';
import '../constants.dart';
import 'wedget/product.dart';


class ProductList extends StatelessWidget {

  const ProductList({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GetBuilder<HomeController>(
      builder: (controller) => Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children:  [
              Text("Hàng mới về",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 17,color: bLtitleColor),),
              GestureDetector(
                onTap: () {
                  Navigator.push(context, MaterialPageRoute(builder: (context) => ProductNes(),),);
                },
                child: Text("Tất cả",style: TextStyle(fontWeight: FontWeight.w400,fontSize: 15,color: priceColor),),
              ),
            ],
          ),
          const SizedBox(height: 20,),
          AlignedGridView.count(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            // itemCount: 6,
            itemCount: controller.procuctList == null?0:controller.procuctList.length,
            crossAxisCount: 2,
            mainAxisSpacing: 20,
            crossAxisSpacing: 20,
            itemBuilder: (context, index) => Container(
              child: Text("122")),
            ),
            // itemBuilder: (context, index) => ProductItem(
            //   product: controller.procuctList[index]),
            // ),
        ],
      ),
    );
  }
}