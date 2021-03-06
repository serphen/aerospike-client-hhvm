HHVM_EXTENSION(aerospike-hhvm
    main/ext_aerospike.cpp
    main/conversions.cpp
    main/policy.cpp
    main/helper.cpp
    main/batch_op_manager.cpp
    main/scan_operation.cpp
    main/udf_operations.cpp)
HHVM_DEFINE(aerospike-hhvm -DAEROSPIKE_C_CHECK)
include_directories(include)
target_link_libraries(aerospike-hhvm /usr/lib/libaerospike.so)
include_directories(/usr/include/aerospike)
set(CMAKE_CXX_FLAGS "${CMAKE_CXX_FLAGS} -g -O0")
set(CMAKE_BUILD_TYPE Debug)
HHVM_SYSTEMLIB(aerospike-hhvm ext_aerospike.php)

