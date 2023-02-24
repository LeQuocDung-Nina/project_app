import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:getwidget/getwidget.dart';
import '../constants.dart';

class BodyWaiting extends StatefulWidget {
  @override
  State<BodyWaiting> createState() => _BodyWaitingState();
}

class _BodyWaitingState extends State<BodyWaiting> {
  @override
  Widget build(BuildContext context) {
    return
        Stack(
          children: [
            SingleChildScrollView(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    // mainAxisAlignment: MainAxisAlignment.start,
                    // crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Radio(value: "", groupValue: "", onChanged: (index){}),
                      Column(
                        mainAxisAlignment: MainAxisAlignment.start,
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: const [
                          Text("Chờ lấy hàng",style: TextStyle(fontSize: 18,fontWeight: FontWeight.w700,color: kTextColor),),
                          SizedBox(height: 10),
                          Text("Đơn hàng của bạn đã xác nhận đang đợi lấy hàng",style: TextStyle(fontSize: 13,fontWeight: FontWeight.w700,color: bLtitle2Color),),
                        ],
                      )
                    ],
                  ),
                  const SizedBox(height: 25,),
                  Row(
                    // mainAxisAlignment: MainAxisAlignment.start,
                    // crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Container(
                        width: 20,
                        height: 16,
                        margin: const EdgeInsets.only(right: 10),
                        child: Image.asset("assets/images/ship.png"),
                      ),
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: const [
                          Text("Đơn hàng đã được đặt",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 13,color: bLtitle2Color),),
                          SizedBox(height: 10,),
                          Text("Đơn hàng của bạn đã được đặt",style: TextStyle(fontWeight: FontWeight.w400,fontSize: 13,color: bLtitle2Color),),
                        ],
                      )
                    ],
                  ),
                  const SizedBox(height: 25,),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.start,
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Container(
                        width: 20,
                        height: 18,
                        margin: const EdgeInsets.only(right: 10),
                        child: Image.asset("assets/images/Location.png"),
                      ),
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: const [
                          Text("Bảo Ngọc",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 13,color: bLtitle2Color),),
                          SizedBox(height: 10,),
                          Text("Địa chỉ: 123 Đường A, Phường B, Quận C, Tp. Hồ Chí Minh",style: TextStyle(fontWeight: FontWeight.w400,fontSize: 13,color: bLtitle2Color),),
                        ],
                      )
                    ],
                  ),
                  const SizedBox(height: 45,),
                  const Text("Sản phẩm",style: TextStyle(fontSize: 16,fontWeight: FontWeight.w700,color: kTextColor),),
                  const SizedBox(height: 15,),
                  SingleChildScrollView(
                    scrollDirection: Axis.vertical,
                    child: Column(
                      children: [
                        for(int i = 0; i <= 10; i++)
                          Container(
                            margin: EdgeInsets.only(bottom: 10),
                            child: Row(
                              children: [
                                Container(
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(10),
                                  ),
                                  width: 80,
                                  height: 80,
                                  margin: EdgeInsets.only(right: 15.0),
                                  child: Image.asset("assets/images/product1.png"),
                                ),
                                Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                                  children: [
                                    const Text("Áo thun nữ thời trang",style: TextStyle(color: backtitleColor,fontSize: 15),),
                                    RichText(text: const TextSpan(
                                        style: TextStyle(color: priceColor,fontSize: 18),
                                        children: [
                                          TextSpan(text: "290.000",),
                                          TextSpan(text: "đ",),
                                        ]
                                    )),
                                    RichText(text: const TextSpan(
                                        style: TextStyle(color: bLtitle2Color,fontSize: 15),
                                        children: [
                                          TextSpan(text: "x",),
                                          TextSpan(text: "1",),
                                        ]
                                    )),
                                  ],
                                ),
                              ],
                            ),
                          ),
                      ],
                    ),

                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      RichText(text: const TextSpan(
                          style: TextStyle(color: bLtitle2Color,fontSize: 14),
                          children: [
                            TextSpan(text: "2 ",),
                            TextSpan(text: "Mặt hàng: ",),
                            TextSpan(text: "380.000",),
                            TextSpan(text: "đ",),
                          ]
                      )),
                    ],
                  ),
                  const SizedBox(height: 15,),
                  const Text("Tóm tắt yêu cầu",style: TextStyle(fontSize: 16,fontWeight: FontWeight.w700,color: kTextColor),),
                  const SizedBox(height: 15,),
                  Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children:  [
                      const Text("Tổng phụ",style: TextStyle(fontSize: 15,fontWeight: FontWeight.w400,color: kTextLightColor),),
                      RichText(text: const TextSpan(
                          style: TextStyle(fontSize: 16,fontWeight: FontWeight.w700,color: kTextLightColor),
                          children: [
                            TextSpan(text: "580.000",),
                            TextSpan(text: "đ",),
                          ]
                      )),
                    ],
                  ),
                  const SizedBox(height: 15,),
                  Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      const Text("Phí giao hàng",style: TextStyle(fontSize: 15,fontWeight: FontWeight.w400,color: kTextLightColor),),
                      RichText(text: const TextSpan(
                          style: TextStyle(fontSize: 15,fontWeight: FontWeight.w400,color: kTextLightColor),
                          children: [
                            TextSpan(text: "20.000",),
                            TextSpan(text: "đ",),
                          ]
                      )),
                    ],
                  ),
                  const SizedBox(height: 15,),
                  Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      const Text("Khuyến mãi",style: TextStyle(fontSize: 15,fontWeight: FontWeight.w400,color: kTextLightColor),),
                      RichText(text: const TextSpan(
                          style: TextStyle(fontSize: 15,fontWeight: FontWeight.w400,color: kTextLightColor),
                          children: [
                            TextSpan(text: "-",),
                            TextSpan(text: "20.000",),
                            TextSpan(text: "đ",),
                          ]
                      )),
                    ],
                  ),
                  const SizedBox(height: 25,),

                  Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      const Text("Tổng",style: TextStyle(fontSize: 15,fontWeight: FontWeight.w400,color: kTextLightColor),),
                      RichText(text: const TextSpan(
                          style: TextStyle(fontSize: 16,fontWeight: FontWeight.w700,color: priceColor),
                          children: [
                            TextSpan(text: "580.000",),
                            TextSpan(text: "đ",),
                          ]
                      )),
                    ],
                  ),
                ],
              ),
            ),
          ]
    );
  }
}
