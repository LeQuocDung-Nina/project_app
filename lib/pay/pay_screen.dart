import 'package:flutter/material.dart';
import '../constants.dart';
import '../order_success/order_success_screen.dart';
import 'wedget/deliverytime.dart';
import 'wedget/infor_line.dart';
import 'wedget/order_notes.dart';
import 'wedget/product_order.dart';
import 'wedget/receive.dart';
import 'wedget/voucher.dart';

class PayScreen extends StatelessWidget {
  const PayScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text("Thanh toán",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 19,color: bLtitleColor),),
      ),
      body: SingleChildScrollView(
        child: Container(
          padding: EdgeInsets.symmetric(vertical: 0,horizontal: 20),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisAlignment: MainAxisAlignment.start,
            children: const [
              Receive(),
              SizedBox(height: 30,),
              DeliveryTime(),
              SizedBox(height: 30,),
              OrderNotes(),
              SizedBox(height: 30,),
              ProductOrder(),
              SizedBox(height: 30,),
              Voucher(),
              SizedBox(height: 30,),
              InforLine(),
            ],
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
            Expanded(flex: 3, child: Column(
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
            Expanded(
              flex: 2,
              child: SizedBox(
                height: 50,
                child: ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    primary: priceColor,
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10),),
                  ),
                  onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (context) => OrderSuccess_screen(),)),
                  child: Text("Đặt hàng",style: TextStyle(color: Colors.white,fontSize: 16,fontWeight: FontWeight.w700),),),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

