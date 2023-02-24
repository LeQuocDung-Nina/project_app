import 'package:flutter/material.dart';

import '../constants.dart';
import '../order/order_screen.dart';

class OrderSuccess_screen extends StatelessWidget {
  const OrderSuccess_screen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(),
      body: Center(
        child: Padding(
          padding: const EdgeInsets.symmetric(vertical: 0,horizontal: 20),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Image.asset("assets/images/OrderSuccess.png"),
              const SizedBox(height: 30,),
              const Text("Đặt Hàng Thành Công",style: TextStyle(fontSize: 23,fontWeight: FontWeight.w700,color: bLtitleColor),),
              const SizedBox(height: 10,),
              const Align(child: Text("Đơn hàng của bạn đã được đặt thành công để biết thêm chi tiết đi đến đơn đặt hàng của tôi.",
                textAlign: TextAlign.center,
                style: TextStyle(fontSize: 15,fontWeight: FontWeight.w400,color: greysuccessplus,height: 2),),
              ),
              const SizedBox(height: 30,),
              Container(
                width: double.maxFinite,
                height: 54,
                child: ElevatedButton(onPressed: () => Navigator.push(context, MaterialPageRoute(builder: (context) => OrderScreen(),)),
                  style: ElevatedButton.styleFrom(
                    primary: priceColor,
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15)),
                  ),
                  child: Text("Xem đơn hàng",style: TextStyle(color: Colors.white,fontSize: 17,fontWeight: FontWeight.w700),),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
