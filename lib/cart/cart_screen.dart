import 'package:demo1/cart/widget/cart_item.dart';
import 'package:flutter/material.dart';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';
import 'package:getwidget/getwidget.dart';

import '../constants.dart';
import '../pay/pay_screen.dart';
import 'model/cart_model.dart';

class CartScreen extends StatelessWidget {
  const CartScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text("Giỏ hàng",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 19,color: bLtitleColor),),
      ),
      body: SingleChildScrollView(
        child: Container(
          padding: EdgeInsets.symmetric(vertical: 0,horizontal: 20),
          child: AlignedGridView.count(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            itemCount: carts.length,
            crossAxisCount: 1,
            mainAxisSpacing: 20,
            crossAxisSpacing: 20,
            itemBuilder: (context, index) => CartItem(
                cart: carts[index]),
          ),
        ),
      ),
      bottomNavigationBar: Container(
        padding: EdgeInsets.symmetric(vertical: 20,horizontal: 20),
        height: 110,
        child: Row(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Row(
              children: [
                GFCheckbox(
                  size: 28,
                  activeBgColor: GFColors.DANGER,
                  // type: GFCheckboxType.square,
                  onChanged: (value) {
                    setState(() {
                      isChecked = value;
                    });
                  },
                  value: isChecked,
                  inactiveIcon: null,
                ),
                Text("Tất cả",style: TextStyle(color: kTextColor,fontSize: 15,fontWeight: FontWeight.w400),)
              ],
            ),
            Expanded(child: Column(
              crossAxisAlignment: CrossAxisAlignment.center,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                RichText(
                  text: const TextSpan(
                    text: "Tạm tính: ",
                    style: TextStyle(color: priceColor,fontWeight: FontWeight.w700,fontSize: 16),
                    children: [
                      TextSpan(text: "290000"),
                      TextSpan(text: "đ"),
                    ]),
                ),
                RichText(
                  text: const TextSpan(
                      text: "(",
                      style: TextStyle(color: bLtitle2Color,fontSize: 13),
                      children: [
                        TextSpan(text: "1 "),
                        TextSpan(text: "Sản phẩm)"),
                      ]),
                ),
              ],
            ),),
            SizedBox(
              height: 50,
              child: ElevatedButton(
                style: ElevatedButton.styleFrom(
                  primary: priceColor,
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10),),
                ),
                onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (context) => PayScreen(),)),
                child: Text("Đặt hàng",style: TextStyle(color: Colors.white,fontSize: 16,fontWeight: FontWeight.w700),),),
            ),
          ],
        ),
      ),
    );
  }
}
