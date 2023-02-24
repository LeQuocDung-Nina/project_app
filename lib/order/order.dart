import '../constants.dart';
import 'body_order.dart';
import 'package:flutter/material.dart';

class OrderScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text('Đơn hàng',style: TextStyle(fontSize: 18,fontWeight: FontWeight.bold,color: bLtitleColor),),
        // leading: IconButton(
        //   icon: Image.asset("assets/images/arrow-left.png"),
        //   onPressed: (){
        //     Navigator.of(context).pop();
        //   },
        // ),
      ),
      body: Container(
        color: Colors.white,
        padding: EdgeInsets.symmetric(vertical: 0,horizontal: 15.0),
        child: Body(),
      ),

    );
  }
}
